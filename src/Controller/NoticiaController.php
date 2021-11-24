<?php

namespace App\Controller;

use Exception;
use App\Entity\Noticia;
use App\Entity\Categoria;
use App\Form\NoticiaType;
use App\Entity\Comentario;
use Doctrine\ORM\Query\Expr\Select;
use App\Repository\NoticiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/noticias")
 */
class NoticiaController extends AbstractController
{
    /**
     * @Route("/", name="noticias", methods={"GET"})
     * 
     *  Muestra todas las noticias
     */
    public function noticias(NoticiaRepository $noticiaRepository): Response
    {
        /**
         * Obtenemos todas las noticias, y donde además saldrán desde las más actuales a las más antiguas, 
         * y si no hay noticias se montrará la página de error
         */
        try {
            return $this->render('noticia/noticias.html.twig', [
                'noticias' => $noticiaRepository->findBy(array(), array('fecha' => 'DESC')),
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', ['error' => $e]);
        }
    }

    /**
     * @Route("/noticia/new", name="nuevaNoticia", methods={"GET", "POST"})
     * 
     * Publicar nueva noticia
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $noticia = new Noticia();
        $form = $this->createFormBuilder($noticia)
            ->add('titular', TextType::class)
            ->add('entradilla', TextareaType::class, array('required' => true))
            ->add('cuerpo', TextareaType::class, array('required' => true))
            ->add('categoria', EntityType::class, ['class' => Categoria::class, 'choice_label' => 'nombre'])
            ->add('imagen', FileType::class, array('required' => true, 'label' => 'Imagen:'))
            ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $noticia->setUsuario($this->getUser());
            $noticia->setFecha(new \DateTime());

            // Aquí con los datos del archivo de la imagen formatearemos el nombre del archivo (String), que es como se guarda en la BD
            $imagen = $form['imagen']->getData();
            $extesion = $imagen->guessExtension();

            // Generamos un string random para la imagen
            $bytes = random_bytes(20);
            $nombre_imagen =  bin2hex($bytes) . '.' . $extesion;
            // Movemos la imagen subida desde la carpeta temporal de PHP a la de nuestro proyecto
            $imagen->move('images', $nombre_imagen);

            //Ahora ya podemos asignar a la noticia la imagen
            $noticia->setImagen($nombre_imagen);

            $entityManager->persist($noticia);
            $entityManager->flush();

            return $this->redirectToRoute('noticia', ['id' => $noticia->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/new.html.twig', [
            'noticia' => $noticia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/noticia/{id}", name="noticia", methods={"GET", "POST"})
     * 
     * Mostramos una noticia
     */
    public function noticia($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $noticia = $entityManager->getRepository(Noticia::class)->find($id);

        $comentarios = $entityManager->getRepository(Comentario::class)->findBy(
            ['noticia' => $noticia]
        );



        $comentario = new Comentario();

        $form = $this->createFormBuilder($comentario)
            ->add('texto', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comentario = $form->getData();

            $comentario->setUsuario($this->getUser());
            $comentario->setNoticia($noticia);
            $comentario->setFecha(new \DateTime());

            $entityManager->persist($comentario);

            $entityManager->flush();
            return $this->redirectToRoute('noticia', ['id' => $noticia->getId()]);
        }

        return $this->render('noticia/noticia.html.twig', ['form' => $form->createView(), 'noticia' => $noticia, 'comentarios' => $comentarios]);
    }

    /**
     * @Route("noticia/edit/{id}", name="editarNoticia", methods={"GET", "POST"})
     */
    public function edit(Request $request, Noticia $noticia, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($noticia)
            ->add('titular', TextType::class, array('required' => true, 'data' => $noticia->getTitular()))
            ->add('entradilla', TextareaType::class, array('required' => true))
            ->add('cuerpo', TextareaType::class, array('required' => true))
            ->add('categoria', EntityType::class, ['class' => Categoria::class, 'choice_label' => 'nombre'])
            ->add('imagen', FileType::class, array('label' => 'Imagen:', 'mapped' => false))
            ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $noticia->setUsuario($this->getUser());

            // Aquí con los datos del archivo de la imagen formatearemos el nombre del archivo (String), que es como se guarda en la BD
            $imagen = $form['imagen']->getData();
            $extesion = $imagen->guessExtension();

            // Generamos un string random para la imagen
            $bytes = random_bytes(20);
            $nombre_imagen =  bin2hex($bytes) . '.' . $extesion;
            // Movemos la imagen subida desde la carpeta temporal de PHP a la de nuestro proyecto
            $imagen->move('images', $nombre_imagen);

            //Ahora ya podemos asignar a la noticia la imagen
            $noticia->setImagen($nombre_imagen);

            $entityManager->persist($noticia);
            $entityManager->flush();

            return $this->redirectToRoute('noticia', ['id' => $noticia->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/edit.html.twig', [
            'noticia' => $noticia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("noticia/delete/{id}", name="eliminarNoticia", methods={"POST"})
     */
    public function delete(Request $request, Noticia $noticia, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $noticia->getId(), $request->request->get('_token'))) {
            $entityManager->remove($noticia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noticias', [], Response::HTTP_SEE_OTHER);
    }
}
