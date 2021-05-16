<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use App\Repository\QusetionQuizRepository;
use Proxies\__CG__\App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/quiz")
 */
class QuizController extends AbstractController
{
    /**
     * @Route("/imp", name="imp", methods={"GET"})
     */
    public function imp(): Response
    {
        $quiz = $this->getDoctrine()
            ->getRepository(Quiz::class)
            ->findAll();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('quiz/print.html.twig',
            [ 'quizzes' => $quiz
                ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("quiz.pdf", [
            "Attachment" => true
        ]);

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quiz

        ]);
    }
    /**
     * @Route("/triiQ", name="triQ", methods={"GET"})
     */
    public function tri(Request $request,NormalizerInterface $Normalizer,QuizRepository $quizRepository) : Response
    {

        $requestString=$request->get('tri');
        $students = $quizRepository->tri($requestString);
        $jsonContent = $Normalizer->normalize($students, 'json',['groups'=>'quiz:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }
    /**
     * @Route("/", name="quiz_index", methods={"GET"})
     */
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quiz_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('quiz_index');
        }

        return $this->render('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quiz_show", methods={"GET"})
     */
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quiz_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quiz $quiz): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quiz_index');
        }

        return $this->render('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quiz_delete", methods={"POST"})
     */
    public function delete(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quiz_index');
    }
    /**
     * @Route("/{id}/showquiz",name="show_quiz" ,requirements={"id"="\d+"})
     */
    //quizRepository $repo, Request $request): Response
    public function show_quiz(quizRepository $repo, $id): Response
    {

        $articles = $repo->showquiz1($id);


        return $this->render('quiz/quizfront.html.twig',[
        'quiz' => $articles,

        ]);

    }

    /**
     * @param quizRepository $rep
     * @param Request $req
     * @return Response
     * @Route("/quiz/searchQ",name="recherche1")
     */

    public function search3(quizRepository $annonceRepository,Request $req )
    {
        $data=$req->get('rs1');

        $quiz=$annonceRepository->findBy(['nom_quiz'=>$data]);

        return $this->render('quiz/index.html.twig',[
            'quizzes'=>$quiz,

        ]);


    }



}
