<?php

namespace App\Repository;

use App\Entity\QusetionQuiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QusetionQuiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method QusetionQuiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method QusetionQuiz[]    findAll()
 * @method QusetionQuiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QusetionQuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QusetionQuiz::class);
    }

    // /**
    //  * @return QusetionQuiz[] Returns an array of QusetionQuiz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QusetionQuiz
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
