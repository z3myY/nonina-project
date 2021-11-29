<?php

namespace App\Repository;

use App\Entity\LikesComentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LikesComentario|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikesComentario|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikesComentario[]    findAll()
 * @method LikesComentario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikesComentario::class);
    }
}
