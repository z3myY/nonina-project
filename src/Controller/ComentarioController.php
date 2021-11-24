<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Entity\Comentario;
use App\Form\ComentarioType;
use Doctrine\ORM\EntityManager;
use App\Repository\ComentarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/comentario")
 */
class ComentarioController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="editar_comentario", methods={"GET", "POST"})
     */
    public function edit(Request $request, Comentario $comentario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($comentario)
            ->add('texto', TextareaType::class, array('required' => true))
            ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $comentario->setUsuario($this->getUser());
            $comentario->setFecha(new \DateTime());

            $entityManager->persist($comentario);
            $entityManager->flush();

            return $this->redirectToRoute('noticia', ['id' => $comentario->getNoticia()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/edit.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/borrar/{id}", name="borrar_comentario", methods={"POST"})
     */
    public function delete(Request $request, Comentario $comentario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comentario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comentario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noticia', ['id' => $comentario->getNoticia()->getId()], Response::HTTP_SEE_OTHER);
    }
}
