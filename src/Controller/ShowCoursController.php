<?php

namespace App\Controller;

use App\Entity\Tableformations;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\TableformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TablecoursRepository;
use Symfony\Component\HttpFoundation\Request;

class ShowCoursController extends AbstractController
{
    /**
     * @Route("{id}/show/cours", name="show_cours" , methods={"GET","POST"})
     */
    public function index(Tableformations  $t ,Request $request): Response
    {
        //commentaire
        //cree commentaire "vierge"
        $comment = new Comments;
        //le formulaire
        $commentForm = $this->createForm(CommentsType::class, $comment);
        $commentForm->handleRequest($request);
        //traitement
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
          $comment->setCreatedAt(new \DateTime());
          $comment->setFormations($t);
          $em= $this->getDoctrine()->getManager();
          $em->persist($comment);
          $em->flush();

          $this->addFlash('message','Votre commentaire a bien été envoyé');
          return $this->redirectToRoute('show_cours',['id' => $t->getId()]);
        }

        return $this->render('show_cours/index.html.twig', [
            't' => $t,
            'cours' => $t->getCours(),
            'commentForm' => $commentForm->createView()
        ]);

    }

}
