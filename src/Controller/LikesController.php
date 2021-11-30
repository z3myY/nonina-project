<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Comentario;
use App\Entity\LikesComentario;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class LikesController extends AbstractController
{

    /**
     * @Route("/darLike/{idUsuario}/{idComentario}", name="likeComentario", methods={"GET", "POST"})
     */

    public function darLikeComentario($idUsuario, $idComentario)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comentario = $entityManager->getRepository(Comentario::class)->find($idComentario);
        $usuario  = $entityManager->getRepository(Usuario::class)->find($idUsuario);

        $like = new LikesComentario();

        $like->setUsuario($usuario)
            ->setComentario($comentario);

        $entityManager->persist($like);
        $entityManager->flush();

        return new Response("OK");
    }

    /**
     * @Route("/contarLikes/{idComentario}", name="contarLikesComentario", methods={"GET"})
     */
    public function contarLikes($idComentario): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comentario = $entityManager->getRepository(Comentario::class)->findBy(['id' => $idComentario]);
        $likesComentario = $entityManager->getRepository(LikesComentario::class)->findBy(['comentario' => $comentario]);
        return new Response(count($likesComentario));
    }

    /**
     * @Route("/quitarLike/{idUsuario}/{idComentario}", name="dislikeComentario", methods={"GET", "POST"})
     */
    public function quitarLike($idUsuario, $idComentario): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $likeComentario = $entityManager->getRepository(LikesComentario::class)->findOneBy(['usuario' => $idUsuario, 'comentario' => $idComentario]);

        $entityManager->remove($likeComentario);
        $entityManager->flush();
        return new Response("OK");
    }
}
