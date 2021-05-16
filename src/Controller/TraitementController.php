<?php

namespace App\Controller;

use App\Entity\Traitement;
use App\Form\TraitementType;
use App\Repository\ReclamationRepository;
use App\Repository\TraitementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/traitement")
 */
class TraitementController extends AbstractController
{
    /**
     * @Route("/", name="traitement_index", methods={"GET"})
     */
    public function index(TraitementRepository $traitementRepository): Response
    {
        return $this->render('traitement/index.html.twig', [
            'traitements' => $traitementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="traitement_new", methods={"GET","POST"})
     */
    public function new(int $id,Request $request,ReclamationRepository $reclamationRepo,\Swift_Mailer $mailer): Response
    {
        $traitement = new Traitement();
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);
        $Reclamation = $reclamationRepo->find($id);
        $traitement->setIdReclamation($Reclamation);
        $Reclamation->setEtat("Traité");
        if ($form->isSubmitted() && $form->isValid()) {


            $message = (new \Swift_Message('You got mail'))

                ->setFrom('salhine.oumayma@esprit.tn')

                ->setTo('ahmed.kalai@esprit.tn')

                ->setSubject('Votre réclamation a été enregistrée !')


                ->setBody($traitement->getCommentaire() );


            $mailer->send($message);
            $this->addFlash('message', 'Le message a bien été envoyé');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($traitement);
            $entityManager->persist($Reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('traitement_index');
        }

        return $this->render('traitement/new.html.twig', [
            'traitement' => $traitement,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="traitement_show", methods={"GET"})
     */
    public function show(Traitement $traitement): Response
    {
        return $this->render('traitement/show.html.twig', [
            'traitement' => $traitement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="traitement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Traitement $traitement): Response
    {
        $form = $this->createForm(TraitementType::class, $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('traitement_index');
        }

        return $this->render('traitement/edit.html.twig', [
            'traitement' => $traitement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traitement_delete", methods={"POST"})
     */
    public function delete(Request $request, Traitement $traitement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traitement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($traitement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('traitement_index');
    }


}
