<?php

namespace App\Controller;

use App\Entity\Tablecours;
use App\Entity\Tableformations;
use App\Form\TablecoursType;
use App\Repository\TablecoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/cours")
 */
class CoursController extends AbstractController
{
    /**
     *@Route("/api/")
     */
    public function showAll(NormalizerInterface $Normalizer){
        $cours = $this->getDoctrine()->getRepository(Tablecours::class)->findAll();
       // $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer()]);
        $formatted = $Normalizer->normalize($cours, 'json',['groups' =>'cours:read']);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/", name="cours_index", methods={"GET"})
     */
    public function index(TablecoursRepository $tablecoursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'tablecours' => $tablecoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tablecour = new Tablecours();
        $form = $this->createForm(TablecoursType::class, $tablecour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tablecour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/new.html.twig', [
            'tablecour' => $tablecour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_show", methods={"GET"})
     */
    public function show(Tablecours $tablecour): Response
    {
        return $this->render('cours/show.html.twig', [
            'tablecour' => $tablecour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tablecours $tablecour): Response
    {
        $form = $this->createForm(TablecoursType::class, $tablecour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/edit.html.twig', [
            'tablecour' => $tablecour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_delete", methods={"POST"})
     */
    public function delete(Request $request, Tablecours $tablecour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tablecour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tablecour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_index');
    }

  //  /**
   //  * @Route("/searchcours ", name="searchcours")
     //*/
    //public function searchcours(Request $request,NormalizerInterface $Normalizer)
    //{
      //  $repository = $this->getDoctrine()->getRepository(Tablecours::class);
        //$requestString=$request->get('searchValue');
        //$cours = $repository->findCoursByTitre($requestString);
        //$jsonContent = $Normalizer->normalize($cours, 'json',['groups'=>'cours:read']);
        //$retour=json_encode($jsonContent);
        //return new Response($retour);

    //}


  //  /**
    // * @Route("/rechercheC", name="rechercheC")
     //*/
    //public function recherche(TablecoursRepository $tablecoursRepository, Request $request): Response
    //{$data=$request->get("search");

      //  $tablecours =$tablecoursRepository->findBy(["Titre"=>$data]) ;
        //return $this->render('cours/index.html.twig', [
          //  'tablecours' => $tablecours,
        //]);
    //}

}
