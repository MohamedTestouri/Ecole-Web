<?php

namespace App\Controller;

use App\Repository\TableformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueFController extends AbstractController
{
    /**
     * @Route("/statistique/f", name="statistique_f")
     */

    public function statistiques(TableformationsRepository $tableformationsRepository)
    {
        $formations = $tableformationsRepository->findAll();
        $formationT =[];
        $formationCount=[];
        $formationCount1=[];
        foreach($formations as $formation){
            $formationT[]=$formation->getTitre();
            $formationCount1[]=$formation->getPrix();
            $formationCount[]=count($formationCount1);
        }
        return $this->render('formations/stats.html.twig',[
            'formationT' => json_encode($formationT),
            'formationCount' => json_encode($formationCount)
        ]);
    }
}
