<?php

// src/Controller/WebController.php

namespace App\Controller;

use Exception;
use App\Entity\Noticia;
use App\Entity\Comentario;
use Symfony\Component\Mime\Email;
use App\Repository\NoticiaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use function PHPUnit\Framework\throwException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class WebController extends AbstractController
{

    // Función para la portada del sitio web
    public function index(NoticiaRepository $repository)
    {

        $entityManager = $this->getDoctrine()->getManager();

        // Obtenemos las 3 útlimas noticias del equipo, es decir con la categoría 'Team'

        try {
            $noticias = $repository->encontrarTresUltimasNoticiasTeam('Team');

            return $this->render('index.html.twig', array(
                'noticias' => $noticias,
            ));
        } catch (Exception $e) {
            return $this->render('error.html.twig', ['error' => $e]);
        }
    }

    // Método simple, renderiza el apartado de ¿Quienes somos?, que es una página estática

    public function conocenos()
    {
        return $this->render('nosotros.html.twig');
    }

    // Método simple, renderiza la página estática de la tienda

    public function tienda()
    {
        return $this->render('tienda.html.twig');
    }

    /**
     * Método para mandar email a través de un formulario de contacto, y parte es página estática hablando un poco sobre nosotors
     *  y algunos publicaciones de nuestro instagram
     * 
     * @Route ("/contacto", name="contacto", methods={"GET", "POST"})
     */
    public function enviarEmailContacto(MailerInterface $mailer, Request $request): Response
    {

        $form = $this->createFormBuilder()
            ->add('nombre', TextType::class)
            ->add('email', TextType::class)
            ->add('telefono', NumberType::class)
            ->add('texto', TextareaType::class)
            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Enviar correo')
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $email = (new Email)
                ->from($form->getData()['email'])
                ->to('nonina.team@gmail.com')
                ->subject('Contacto de ' . $form->getData()['nombre'])
                ->text($form->getData()['texto']);

            try {
                $mailer->send($email);
                return $this->render('correo_enviado.html.twig', ['nombre' => $form->getData()['nombre']]);
            } catch (Exception $e) {
                return $this->render('error.html.twig', ['error' => $e]);
            }

            return $this->redirectToRoute('contacto');
        }

        return $this->render('contacto.html.twig', ['form' => $form->createView()]);
    }
}
