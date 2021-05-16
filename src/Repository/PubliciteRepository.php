<?php

namespace App\Repository;

use App\Entity\Publicite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;

/**
 * @method Publicite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publicite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publicite[]    findAll()
 * @method Publicite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PubliciteRepository extends ServiceEntityRepository
{
    public function findStudentByNsc($s){
         $q=$this->createQueryBuilder('p');
           $q
           ->select('p.libelle , p.image, p.start_date ,p.end_date ,p.description ,p.code_promo,p.id')
            ->where('p.libelle LIKE :s')
            ->setParameter('s', '%'.$s.'%');

        return  $q->getQuery()->getResult();

    }
    public function tri( $s){
        $q=$this->createQueryBuilder('p');
        $q
            ->select('p.libelle , p.image, p.start_date ,p.end_date ,p.description ,p.code_promo,p.id')
            ->orderBy('p.libelle', $s);


        return  $q->getQuery()->getResult();

    }
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicite::class);
    }
    public function Qr_creator( $name,$data){
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($data)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->build();
        $destination = $this->getParameter('kernel.project_dir').'/public/assets/QR/'.$name.'.jpg';
        $result->saveToFile($destination);



    }








    // /**
    //  * @return Publicite[] Returns an array of Publicite objects
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
    public function findOneBySomeField($value): ?Publicite
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
