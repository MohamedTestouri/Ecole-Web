<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Exchanger\ExchangeRateQueryBuilder;


/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class TagRepository extends ServiceEntityRepository
{





    public function ff(){
        return $this->createQueryBuilder('tag')
            ->where('tag.state=1')
            ->getQuery()
            ->getResult();
    }

    public function removed(){
        return $this->createQueryBuilder('tag')
            ->where('tag.state=2')
            ->getQuery()
            ->getResult();
    }

    public function update_state($s){
        $con = $this->getEntityManager()->getConnection();

        $st = $con->executeQuery("update tag set tag.state=2 where tag.id=$s");


    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }
    public function search($s){
        $q=$this->createQueryBuilder('t');
        $q
            ->select('t.tag_name,t.id,t.slug')
            ->where('t.tag_name LIKE :s')
            ->setParameter('s', '%'.$s.'%');

        return  $q->getQuery()->getResult();

    }




    // /**
    //  * @return Tag[] Returns an array of Tag objects
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
    public function findOneBySomeField($value): ?Tag
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
