<?php

namespace App\Controller;

use App\Entity\Tableformations;
use App\Form\TableformationsType;
use App\Repository\TableformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Participation;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/formations")
 */
class FormationsController extends AbstractController
{
    /**
     * @Route("/api/")
     */
    public function showAll(NormalizerInterface $Normalizer)
    {
        $formations = $this->getDoctrine()->getRepository(Tableformations::class)->findAll();
        // $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer()]);
        $formatted = $Normalizer->normalize($formations, 'json', ['groups' => 'formations:read']);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/", name="form_index", methods={"GET"})
     */
    public function index(TableformationsRepository $tableformationsRepository): Response
    {
        return $this->render('formations/index.html.twig', [
            'tableformations' => $tableformationsRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="formations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tableformation = new Tableformations();
        $form = $this->createForm(TableformationsType::class, $tableformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tableformation);
            $entityManager->flush();

            return $this->redirectToRoute('form_index');
        }

        return $this->render('formations/new.html.twig', [
            'tableformation' => $tableformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formations_show", methods={"GET"})
     */
    public function show(Tableformations $tableformation): Response
    {
        return $this->render('formations/show.html.twig', [
            'tableformation' => $tableformation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tableformations $tableformation): Response
    {
        $form = $this->createForm(TableformationsType::class, $tableformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_index');
        }

        return $this->render('formations/edit.html.twig', [
            'tableformation' => $tableformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formations_delete", methods={"POST"},requirements={"id":"\d+"})
     */
    public function delete(Request $request, Tableformations $tableformation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tableformation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tableformation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_index');
    }


    /**
     * @Route("/stats ", name="stats")
     */
    public function statistiques(TableformationsRepository $tableformationsRepository)
    {
        $formations = $tableformationsRepository->findAll();
        $formationT = [];
        $formationCount = [];
        foreach ($formations as $formation) {
            $formationT[] = $formation->getTitre();
            $formationCount[] = count($formation->getType());
        }
        return $this->render('formations/index.html.twig', [
            'formationT' => json_encode($formationT),
            'formationCount' => json_encode($formationCount)
        ]);
    }

    /**
     * @Route("/rechercheFor", name="rechercheFor")
     */
    public function recherche(TableformationsRepository $tableformationsRepository, Request $request): Response
    {
        $data = $request->get("search");

        $tableformations = $tableformationsRepository->findBy(["Titre" => $data]);
        return $this->render('formations/index.html.twig', [
            'tableformations' => $tableformations,
        ]);
    }

    /**
     * @Route("/{id}/participation", name="participation_add", methods={"GET","POST"})
     */
    public function AddParticipation(Request $request): Response
    {
        $p = new Participation();
        $f = $this->getDoctrine()
            ->getRepository(Tableformations::class)
            ->find($request->get("id"));
        $p->setIdFormation($f);
        $p->setIdClient(1);

        $p1 = $this->getDoctrine()->getRepository(Participation::class)->findOneBy(array(
            'idFormation' => $p->getIdFormation(),
            'idClient' => $p->getIdClient(),
        ));
        if ($p1 == null) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($p);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formations_client');
    }


    /**
     * @Route("/error", name="error")
     */
    public function error(Request $request): Response
    {
        return $this->render('reclamation/error.html.twig', [

        ]);
    }

    /**
     * @Route("/create-checkout-session/{id}", name="checkout")
     */
    public function checkout(Request $request): Response
    {
        \Stripe\Stripe::setApiKey('sk_test_51Il09yEFFHRi1CgQRCmaD2RVwItIPXjJkMnZZAdbqjKQKwzEPZhSLXsxJ0su1OxWxc9wKqJRm0IV5puXzaHk9R2x004m9mBpWP');
        $p = new Participation();
        $f = $this->getDoctrine()
            ->getRepository(Tableformations::class)
            ->find($request->get("id"));
        $p->setIdFormation($f);
        $p->setIdClient(1);

        $p1 = $this->getDoctrine()->getRepository(Participation::class)->findOneBy(array(
            'idFormation' => $p->getIdFormation(),
            'idClient' => $p->getIdClient(),
        ));
        if ($p1 == null) {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $f->getTitre(),
                        ],
                        'unit_amount' => $f->getPrix() * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $this->generateUrl('participation_add', ['id' => $request->get("id")], UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
            ]);
            return new JsonResponse(['id' => $session->id]);
        } else {
            return $this->redirectToRoute('formations_client');
        }

    }


}
