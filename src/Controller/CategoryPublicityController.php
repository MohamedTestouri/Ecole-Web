<?php

namespace App\Controller;

use App\Entity\CategoryPublicity;
use App\Form\CategoryPublicityType;
use App\Repository\CategoryPublicityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category/publicity")
 */
class CategoryPublicityController extends AbstractController
{
    /**
     * @Route("/", name="category_publicity_index", methods={"GET"})
     */
    public function index(CategoryPublicityRepository $categoryPublicityRepository): Response
    {
        return $this->render('category_publicity/index.html.twig', [
            'category_publicities' => $categoryPublicityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_publicity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoryPublicity = new CategoryPublicity();
        $form = $this->createForm(CategoryPublicityType::class, $categoryPublicity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoryPublicity);
            $entityManager->flush();

            return $this->redirectToRoute('category_publicity_index');
        }

        return $this->render('category_publicity/new.html.twig', [
            'category_publicity' => $categoryPublicity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_publicity_show", methods={"GET"})
     */
    public function show(CategoryPublicity $categoryPublicity): Response
    {
        return $this->render('category_publicity/show.html.twig', [
            'category_publicity' => $categoryPublicity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_publicity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryPublicity $categoryPublicity): Response
    {
        $form = $this->createForm(CategoryPublicityType::class, $categoryPublicity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_publicity_index');
        }

        return $this->render('category_publicity/edit.html.twig', [
            'category_publicity' => $categoryPublicity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_publicity_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoryPublicity $categoryPublicity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryPublicity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryPublicity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_publicity_index');
    }
}
