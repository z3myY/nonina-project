<?php

namespace App\Repository;

use App\Entity\Noticia;
use ContainerC46AlwH\getCategoriaRepositoryService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Noticia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noticia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noticia[]    findAll()
 * @method Noticia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoticiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noticia::class);
    }

    /**
     *  @return Noticia[] 
     */
    public function encontrarTresUltimasNoticiasTeam($categoria)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('n') // to make Doctrine actually use the join
            ->from(Noticia::class, 'n')
            ->innerJoin('n.categoria', 'c')
            ->andWhere('c.nombre = :nombre')
            ->setParameter('nombre', $categoria)
            ->orderBy('c.nombre', 'DESC')
            ->setMaxResults(3)
            ->getQuery();

        return $query->getResult();
    }
}
