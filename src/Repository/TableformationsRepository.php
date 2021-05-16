<?php

namespace App\Repository;

use App\Entity\Tableformations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Swap\Builder;

/**
 * @method Tableformations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tableformations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tableformations[]    findAll()
 * @method Tableformations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableformationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tableformations::class);
    }

    public function tridesc(){
            return $this->createQueryBuilder('p')

            ->orderBy('p.Prix' ,'DESC')
            ->getQuery()
            ->getResult();
    }

    public function triASC(){
        return $this->createQueryBuilder('p')

            ->orderBy('p.Prix' ,'ASC')
            ->getQuery()
            ->getResult();
    }
    public function display_recommandations()
    {
        $con = $this->getEntityManager()->getConnection();

        $st = $con->executeQuery("SELECT * FROM `tableformations` WHERE tableformations.id IN(SELECT tag_cours.formation_id FROM `tag_cours` WHERE ((SELECT tag_id FROM `participation` inner join tag_cours on participation.id_formation_id=tag_cours.formation_id order by participation.id_client DESC LIMIT 1)=tag_cours.tag_id))");
        // var_dump($result = $st->fetchAll());
        return $result = $st->fetchAll();


    }
    public function currency($x){

        // Build Swap
        $swap = (new Builder())

            // Use the Fixer.io service as first level provider
            ->add('fixer', ['access_key' => 'd0d9e6a71f20eeee59163ea50dff0dfe'])
            ->build();
        $rate = $swap->latest('EUR/'.$x);
        return $rate->getValue();


    }


    // /**
    //  * @return Tableformations[] Returns an array of Tableformations objects
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
    public function findOneBySomeField($value): ?Tableformations
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
