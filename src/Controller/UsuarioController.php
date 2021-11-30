<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", name="usuario_index", methods={"GET"})
     */
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    /**
     * Método para poder codificar las contraseñas de los usuarios
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/new", name="registro", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = new Usuario();

        $form = $this->createFormBuilder($usuario)
            ->add('nombre', TextType::class)
            ->add('nick', TextType::class)
            ->add('email', TextType::class)
            //No aplicaremos todas las restricciónes desde aquí
            ->add(
                'password',
                RepeatedType::class,
                [
                    'first_options' => ['label' => ' '],
                    'second_options' => ['label' => ' '],
                    'type' => PasswordType::class,
                    'invalid_message' => 'Las contraseñas no coinciden',
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Debes introducir una contraseña con al menos {{ limit }} carácteres',
                            // max length allowed by Symfony for security reasons
                            'max' => 20,
                        ]),
                        new NotBlank([
                            'message' => 'Escriba una contraseña'
                        ]),
                    ],
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Registrarse')
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usuario = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $usuario->setRoles(array('ROLE_USER'));
            $usuario->setPassword($this->passwordEncoder->encodePassword(
                $usuario,
                $usuario->getPassword()
            ));

            $entityManager->persist($usuario);

            $entityManager->flush();
            return $this->redirectToRoute('web_login');
        }
        return $this->render('usuario/registro.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="perfil", methods={"GET"})
     */
    public function perfil(Usuario $usuario): Response
    {
        return $this->render('usuario/perfil.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($usuario)
            ->add('nombre', TextType::class)
            ->add('nick', TextType::class)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Guardar cambios')
            )
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usuario = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $usuario->setPassword($this->passwordEncoder->encodePassword(
                $usuario,
                $usuario->getPassword()
            ));

            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('perfil', ['id' => $usuario->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="borrar_usuario", methods={"POST"})
     */
    public function delete(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usuario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($usuario);
            $entityManager->flush();
        }
       
        //Invalida session antes de redirigir
        $session = $this->get('session');
        $session = new Session();
        $session->invalidate();
        
        return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
    }
}
