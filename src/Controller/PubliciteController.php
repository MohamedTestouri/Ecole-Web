<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\PubliciteType;
use App\Repository\PubliciteRepository;
use App\Repository\TagRepository;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Swap\Builder;



/**
 * @Route("/publicite")
 */
class PubliciteController extends AbstractController
{
    /**
     * @Route("/ajax", name="searchpub", methods={"GET"})
     */
    public function searchStudentx(Request $request,NormalizerInterface $Normalizer,PubliciteRepository $publiciteRepository): Response
    {

        $requestString=$request->get('searchValue');
        $students = $publiciteRepository->findStudentByNsc($requestString);
        $jsonContent = $Normalizer->normalize($students, 'json',['groups'=>'pub:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }
    /**
     * @Route("/trii", name="tripub", methods={"GET"})
     */
    public function tri(Request $request,NormalizerInterface $Normalizer,PubliciteRepository $publiciteRepository): Response
    {

        $requestString=$request->get('tri');
        $students = $publiciteRepository->tri($requestString);
        $jsonContent = $Normalizer->normalize($students, 'json',['groups'=>'pub:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }
    /**
     * @Route("/", name="publicite_index", methods={"GET","POST"})
     */
    public function index(PubliciteRepository $publiciteRepository,Request $request): Response
    {   $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicite);
            $entityManager->flush();
            $result = \Endroid\QrCode\Builder\Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($publicite->getCodePromo())
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->build();
            $destination = $this->getParameter('kernel.project_dir').'/public/assets/QR/'.$publicite->getId().$publicite->getLibelle().'.jpg';
            $result->saveToFile($destination);




            return $this->redirectToRoute('publicite_index');
        }
        return $this->render('publicite/index.html.twig', [
            'publicites' => $publiciteRepository->findAll(),
            'publicite' => $publicite,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/p2", name="publicite_index2", methods={"GET"})
     */
    public function index2(PubliciteRepository $publiciteRepository): Response
    {
        return $this->render('publicite/index2.html.twig', [
            'publicites' => $publiciteRepository->findAll(),



        ]);
    }

    /**
     * @Route("/new", name="publicite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publicite = new Publicite();
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publicite);
            $entityManager->flush();
            $result = \Endroid\QrCode\Builder\Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($publicite->getCodePromo())
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->build();
            $destination = $this->getParameter('kernel.project_dir').'/public/assets/QR/'.$publicite->getId().$publicite->getLibelle().'.jpg';
            $result->saveToFile($destination);



            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/new.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publicite_show", methods={"GET"})
     */
    public function show(Publicite $publicite): Response
    {
        return $this->render('publicite/show.html.twig', [
            'publicite' => $publicite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publicite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publicite $publicite): Response
    {
        $form = $this->createForm(PubliciteType::class, $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicite_index');
        }

        return $this->render('publicite/edit.html.twig', [
            'publicite' => $publicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publicite_delete", methods={"POST"})
     */
    public function delete(Request $request, Publicite $publicite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publicite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publicite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publicite_index');
    }
}
