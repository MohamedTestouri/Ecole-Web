<?php

namespace App\Repository;

use App\Entity\Tablecours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
/**
 * @method Tablecours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tablecours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tablecours[]    findAll()
 * @method Tablecours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablecoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tablecours::class);
    }




    public function findCoursByTitre($Titre){
        return $this->createQueryBuilder('Tablecours')
            ->where('Tablecours.Titre LIKE :Titre')
            ->setParameter('Titre', '%'.$Titre.'%')
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Tablecours[] Returns an array of Tablecours objects
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
    public function findOneBySomeField($value): ?Tablecours
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
