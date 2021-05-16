<?php

namespace App\Controller;

use App\Entity\Tablecours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowOnecoursController extends AbstractController
{
    /**
     * @Route("/{id}/show/onecours", name="show_onecours", methods={"GET"})
     */
    public function index(Tablecours $cours): Response
    {
        return $this->render('show_onecours/index.html.twig', [
            'a' => $cours,
        ]);
    }


}
