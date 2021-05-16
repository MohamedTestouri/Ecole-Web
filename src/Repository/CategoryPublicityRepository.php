<?php

namespace App\Repository;

use App\Entity\CategoryPublicity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryPublicity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPublicity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPublicity[]    findAll()
 * @method CategoryPublicity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPublicityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPublicity::class);
    }

    // /**
    //  * @return CategoryPublicity[] Returns an array of CategoryPublicity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryPublicity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
