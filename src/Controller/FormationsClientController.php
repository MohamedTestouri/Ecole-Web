<?php

namespace App\Controller;

use App\Repository\TableformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FormationsClientController extends Controller
{

    /**
     * @Route("/formations/client/currency", name="currency")
     */
    public function currency(NormalizerInterface $Normalizer,TableformationsRepository $tableformationsRepository, Request $request): Response
    {

        $x=$request->get('currency');
        $z=$request->get('to_cuurency');
        $cc = $tableformationsRepository->currency($x,$z);

        return new Response($cc);



    }

    /**
     * @Route("/formations/client", name="formations_client")
     */
    public function index(TableformationsRepository $tableformationsRepository, Request $request): Response
    {

        $allformations = $tableformationsRepository->findAll();
        $formations=$this->get('knp_paginator')->paginate(
            $allformations,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('formations_client/index.html.twig', [
            'tableformations' => $formations,
        ]);
    }
    /**
     * @Route("/rechercheF", name="rechercheF")
     */
    public function rechercheF(TableformationsRepository $tableformationsRepository, Request $request): Response
    {$data=$request->get("search");
        $tableformations =$tableformationsRepository->findBy(["Type"=>$data]) ;

        $formations=$this->get('knp_paginator')->paginate(
            $tableformations,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('formations_client/index.html.twig', [
            'tableformations' => $formations,
        ]);
    }

    /**
     * @Route("/triDESC", name="triDESC")
     */
    public function triDESC(TableformationsRepository $tableformationsRepository, Request $request): Response
    {

        $tableformations = $tableformationsRepository-> tridesc() ;

        $tableformations=$this->get('knp_paginator')->paginate(
            $tableformations,
            $request->query->getInt('page',1),
            4
        );
        return $this->render('formations_client/index.html.twig', [
            'tableformations' => $tableformations,
        ]);
    }

    /**
     * @Route("/triASC", name="triASC")
     */
    public function triASC(TableformationsRepository $tableformationsRepository, Request $request): Response
    {

        $tableformations = $tableformationsRepository-> triASC() ;

        $tableformations=$this->get('knp_paginator')->paginate(
            $tableformations,
            $request->query->getInt('page',1),
            4
        );
        return $this->render('formations_client/index.html.twig', [
            'tableformations' => $tableformations,
        ]);
    }
}
