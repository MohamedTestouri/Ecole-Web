<?php

namespace App\Controller;

use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatReclamationController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function statistiques(ReclamationRepository $reclamationsrepo){
        $reclamations= $reclamationsrepo->findAll();

        $titreQuiz=[];
        $titreQuizc=[];
        $titreQuiz1=[];


        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT c.type FROM reclamation r ,categorie c WHERE c.id = r.categorie_id GROUP BY c.type;';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($reclamations as $quizz){

            $titreQuiz1[]=$quizz->getCategorie()->getType();

        }

        $i = 0;
        foreach ($result as $results){

            $RAW_QUERY = 'SELECT COUNT(*)  FROM reclamation r ,categorie c WHERE c.id = r.categorie_id AND c.type = :type ;';

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            // Set parameters
            $statement->bindValue('type',$results["type"]);

            $statement->execute();

            $resulttype[] = $statement->fetchAll();

            $data[] = $results["type"];

            $nb[] = $resulttype[$i][0]["COUNT(*)"];
            $i++;
        }


        return $this->render('reclamation_admin/stats.html.twig', [

            'cat'=>json_encode($data),
            'nb'=>json_encode($nb)
        ]);
    }

}

