<?php

namespace App\Controller;

use App\Entity\TagCours;
use App\Form\TagCoursType;
use App\Repository\TagCoursRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/tags/cours")
 */
class TagCoursController extends AbstractController
{
    /**
     * @Route("/", name="tag_cours_index", methods={"GET"})
     */
    public function index(TagCoursRepository $tagCoursRepository): Response
    {
        return $this->render('tag_cours/index.html.twig', [
            'tag_cours' => $tagCoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tag_cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tagCour = new TagCours();
        $form = $this->createForm(TagCoursType::class, $tagCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tagCour);
            $entityManager->flush();

            return $this->redirectToRoute('tag_cours_index');
        }

        return $this->render('tag_cours/new.html.twig', [
            'tag_cour' => $tagCour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_cours_show", methods={"GET"})
     */
    public function show(TagCours $tagCour): Response
    {
        return $this->render('tag_cours/show.html.twig', [
            'tag_cour' => $tagCour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tag_cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TagCours $tagCour): Response
    {
        $form = $this->createForm(TagCoursType::class, $tagCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_cours_index');
        }

        return $this->render('tag_cours/edit.html.twig', [
            'tag_cour' => $tagCour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_cours_delete", methods={"POST"})
     */
    public function delete(Request $request, TagCours $tagCour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tagCour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tagCour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tag_cours_index');
    }

}
