<?php

namespace App\Repository;

use App\Entity\TagCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TagCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagCours[]    findAll()
 * @method TagCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TagCours::class);
    }



    // /**
    //  * @return TagCours[] Returns an array of TagCours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TagCours
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
