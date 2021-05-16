<?php

namespace App\Controller;

use App\Repository\PubliciteRepository;
use App\Repository\QuizRepository;
use App\Repository\TableformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(TableformationsRepository $formationsRepository,Request $request,PubliciteRepository $pub): Response
    {
        $articles = $formationsRepository->display_recommandations();

        return $this->render('user/index.html.twig', [
            't' => $articles,
            'publicites'=>$pub->findAll(),
        ]);
    }
}
