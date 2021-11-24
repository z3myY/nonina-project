<?php

namespace App\Repository;

use App\Entity\PostTema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostTema|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostTema|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostTema[]    findAll()
 * @method PostTema[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostTemaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostTema::class);
    }

    // /**
    //  * @return PostTema[] Returns an array of PostTema objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostTema
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
