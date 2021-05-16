<?php

namespace App\Repository;

use App\Entity\Quiz;
use App\Entity\QusetionQuiz;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

     public function showquiz()
     {


         $dp=$this->createQueryBuilder('p') ;
         $dp
             ->select('qt.question_a , qt.reponse , rp.reponse_1 ,rp.reponse_2 ,rp.reponse_3')
             ->innerjoin('App\Entity\QusetionQuiz','q',JOIN::WITH,'q.quiz=p.id')
             ->innerjoin('App\Entity\Question','qt',JOIN::WITH,'qt.id=q.question')
             ->innerjoin('App\Entity\Reponse','rp',JOIN::WITH,'qt.id=rp.question')
             ->Where('q.quiz=3 ');

         var_dump($dp->getQuery()->getResult());
         return  $dp->getQuery()->getResult();


     }

    /**
     * @param int $id
     * @return mixed
     */

     public function showquiz1($id){

         $con = $this->getEntityManager()->getConnection();

         $st = $con->executeQuery("Select question_a , reponse , reponse_1 ,reponse_2 ,reponse_3 from Quiz q inner join Qusetion_Quiz qq on q.id=qq.quiz_id inner join question qs ON qq.question_id=qs.id inner join reponse rp on rp.question_id=qq.question_id where formation_id=$id");
         //var_dump($result = $st->fetchAll());
         return $result = $st->fetchAll();
}

    public function tri( $s){
        $q=$this->createQueryBuilder('p');
        $q
            ->select('p.id, p.nom_quiz')
            ->orderBy('p.nom_quiz', $s);


        return  $q->getQuery()->getResult();

    }
    // /**
    //  * @return Quiz[] Returns an array of Quiz objects
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
    public function findOneBySomeField($value): ?Quiz
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
