<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('reclamation_admin/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/traite", name="reclamation_index_traite", methods={"GET"})
     */
    public function FindbyTraite(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('reclamation_admin/index.html.twig', [
            'reclamations' => $reclamationRepository->findby(array('etat'=>"Traité")),
        ]);
    }
    /**
     * @Route("/nontraite", name="reclamation_index_nontraite", methods={"GET"})
     */
    public function FindbyNonTraite(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('reclamation_admin/index.html.twig', [
            'reclamations' => $reclamationRepository->findby(array('etat'=>"Non Traité")),
        ]);
    }

    /**
     * @Route("/im", name="im", methods={"GET"})
     */
    public function imp(ReclamationRepository $reclamationRepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reclamation_admin/imp.html.twig',
            [ 'reclamations' => $reclamationRepository->findAll(),
            ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("reclamations.pdf", [
            "Attachment" => true
        ]);

        return $this->render('reclamation_admin/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{titre}", name="reclamation_new", methods={"GET","POST"})
     */
    public function new($titre,Request $request): Response
    {
        $reclamation = new Reclamation();
        $categorie = new Categorie();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        $reclamation->setIdClient();
        $reclamation->setDateReclamation();
        $categorie->setType($titre);
        $reclamation->setCategorie($categorie);
        $reclamation->setEtat("Non Traité");
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('reclamation_showByUser',["id"=>1]);
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    /**
     * @Route("/reclamation_back/{id}", name="reclamation_show_admin", methods={"GET"})
     */
    public function showAdmin(Reclamation $reclamation): Response
    {
        return $this->render('reclamation_admin/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    /**
     * @Route("/ReclamationsClients/{id}", name="reclamation_showByUser", methods={"GET"})
     */
    public function showByUser(int $id,ReclamationRepository $reclamationRepo): Response
    {
        $reclamations = $reclamationRepo->findBy(array("idClient"=>$id));

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation , ReclamationRepository $reclamationRepo): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $reclamations = $reclamationRepo->findBy(array("idClient"=>1));
            return $this->render('reclamation/index.html.twig', [
                'reclamations' => $reclamations,
            ]);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }

    /**
     * @Route("/deleteFront/{id}", name="reclamation_delete_client", methods={"POST"})
     */
    public function deleteClient(Request $request, Reclamation $reclamation , ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }



    /**
     * @param reclamationRepository $rep
     * @param Request $req
     * @return Response
     * @Route("/reclamation/search_admin",name="recherche_admin")
     */
    public function search(reclamationRepository $reclamationRepository,Request $req)
    {
        $data=$req->get('rs');

        $reclamation=$reclamationRepository->findBy(['commentaire'=>$data]);


        return $this->render('reclamation_admin/index.html.twig',[
            'reclamations'=>$reclamation,

        ]);


    }

    /**
     * @param reclamationRepository $rep
     * @param Request $req
     * @return Response
     * @Route("/reclamation/search",name="recherche")
     */
    public function search2(reclamationRepository $reclamationRepository,Request $req)
    {
        $data=$req->get('rs');

        $reclamation=$reclamationRepository->findBy(['commentaire'=>$data]);


        return $this->render('reclamation/index.html.twig',[
            'reclamations'=>$reclamation,

        ]);


    }




}
