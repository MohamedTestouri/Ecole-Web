<?php

namespace App\Controller;

use App\Repository\QusetionQuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/statQ", name="statQ")
     */
    public function statistiques(QusetionQuizRepository $quiz){
        $Quiz= $quiz->findAll();
        $titreQuiz=[];
        $titreQuizc=[];
        $titreQuiz1=[];

        foreach ($Quiz as $quizz){
            $titreQuiz[]=$quizz->getId();
            $titreQuiz1[]=$quizz->getQuiz();
            $titreQuizc[]=count($titreQuiz1);
        }

        return $this->render('quiz/stats.html.twig', [
            'titreQuiz'=>json_encode($titreQuiz),
            'titreQuizc'=>json_encode($titreQuizc)
        ]);
    }

}

