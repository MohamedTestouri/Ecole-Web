<?php

namespace App\Controller;

use App\Entity\Tablecours;
use App\Entity\Tableformations;
use App\Repository\TablecoursRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

class CoursClientController extends Controller
{
    /**
     * @Route("/cours/client", name="cours_client")
     */
    public function index(TablecoursRepository $tablecoursRepository, Request $request): Response
    {
        $allcours = $tablecoursRepository->findAll();

        $cours=$this->get('knp_paginator')->paginate(
            $allcours,
            $request->query->getInt('page',1),
            4
        );
        return $this->render('cours_client/index.html.twig', [
            'tablecours' => $cours,
        ]);
    }
    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche(TablecoursRepository $tablecoursRepository, Request $request): Response
    {

        $data=$request->get("search");

        $tablecours =$tablecoursRepository->findBy(["Titre"=>$data]) ;
        $cours=$this->get('knp_paginator')->paginate(
            $tablecours,
            $request->query->getInt('page',1),
            4
        );
        return $this->render('cours_client/index.html.twig', [
            'tablecours' => $cours,
        ]);
    }

}
