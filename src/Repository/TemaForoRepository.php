<?php

namespace App\Repository;

use App\Entity\TemaForo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TemaForo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemaForo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemaForo[]    findAll()
 * @method TemaForo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemaForoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemaForo::class);
    }
}
