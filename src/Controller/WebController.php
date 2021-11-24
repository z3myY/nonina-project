<?php

// src/Controller/WebController.php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Comentario;
use App\Entity\Noticia;
use App\Repository\NoticiaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use function PHPUnit\Framework\throwException;

class WebController extends AbstractController
{

    // Función para la portada del sitio web
    public function index(NoticiaRepository $repository)
    {

        $entityManager = $this->getDoctrine()->getManager();

        // Obtenemos las 3 útlimas noticias del equipo, es decir con la categoría 'Team'

        try {
            /* $noticias = $entityManager->getRepository(Noticia::class)->findBy(
                array('categoria' => 'Team'), // where 
                array('fecha' => 'DESC'),     // orderBy
                3                             // limit
            ); */

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
}
