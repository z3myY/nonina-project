<?php

namespace App\Controller;

use App\Entity\PostTema;
use App\Entity\TemaForo;
use App\Entity\Categoria;
use App\Form\TemaForoType;
use App\Repository\TemaForoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/foro")
 */
class ForoController extends AbstractController
{
    /**
     * @Route("/", name="foro", methods={"GET"})
     */
    public function foro(TemaForoRepository $temaForoRepository): Response
    {
        return $this->render('foro/foro.html.twig', [
            'temas' => $temaForoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nuevo_tema", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $temaForo = new TemaForo();
        $form = $this->createFormBuilder($temaForo)
            ->add('titulo', TextType::class)
            ->add('descripcion', TextType::class)
            ->add('texto', TextareaType::class)
            ->add('categoria', EntityType::class, ['class' => Categoria::class, 'choice_label' => 'nombre'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $temaForo = $form->getData();
            $temaForo->setUsuario($this->getUser());
            $temaForo->setFecha(new \DateTime());

            $entityManager->persist($temaForo);
            $entityManager->flush();

            return $this->redirectToRoute('tema', ['id' => $temaForo->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('foro/nuevo_tema.html.twig', [
            'tema' => $temaForo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/tema/{id}", name="tema", methods={"GET", "POST"})
     */
    public function tema($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $tema = $entityManager->getRepository(TemaForo::class)->find($id);

        $posts = $entityManager->getRepository(PostTema::class)->findBy(
            ['tema' => $tema]
        );

        $post = new PostTema();

        $form = $this->createFormBuilder($post)
            ->add('texto', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();

            $post->setUsuario($this->getUser());
            $post->setTema($tema);
            $post->setFecha(new \DateTime());

            $entityManager->persist($post);

            $entityManager->flush();
            return $this->redirectToRoute('tema', ['id' => $tema->getId()]);
        }

        return $this->render('foro/tema.html.twig', ['form' => $form->createView(), 'tema' => $tema, 'posts' => $posts]);
    }

    /**
     * @Route("/tema/{id}/edit", name="editar_tema", methods={"GET", "POST"})
     */
    public function editarTema(Request $request, TemaForo $temaForo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($temaForo)
            ->add('titulo', TextType::class)
            ->add('descripcion', TextType::class)
            ->add('texto', TextareaType::class)
            ->add('categoria', EntityType::class, ['class' => Categoria::class, 'choice_label' => 'nombre'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $temaForo = $form->getData();
            $temaForo->setFecha(new \DateTime());

            $entityManager->persist($temaForo);
            $entityManager->flush();

            return $this->redirectToRoute('tema', ['id' => $temaForo->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('foro/edit.html.twig', [
            'tema' => $temaForo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/post/{id}/edit", name="editar_post", methods={"GET", "POST"})
     */
    public function editarPost(Request $request, PostTema $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($post)
            ->add('texto', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();
            $post->setFecha(new \DateTime());

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('tema', ['id' => $post->getTema()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/tema/borrar/{id}", name="borrar_tema", methods={"GET", "POST"})
     */
    public function delete(Request $request, TemaForo $temaForo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $temaForo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($temaForo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('foro', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/post/borrar/{id}", name="borrar_post", methods={"GET", "POST"})
     */
    public function borrarPost(Request $request, PostTema $postTema, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $postTema->getId(), $request->request->get('_token'))) {
            $entityManager->remove($postTema);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tema', ['id' => $postTema->getTema()->getId()], Response::HTTP_SEE_OTHER);
    }
}
