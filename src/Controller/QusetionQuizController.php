<?php

namespace App\Controller;
use App\Entity\Question;
use App\Entity\QusetionQuiz;
use App\Form\QusetionQuizType;
use App\Repository\QuizRepository;
use App\Repository\QusetionQuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/qusetion/quiz")
 */
class QusetionQuizController extends AbstractController
{
    /**
     * @Route("/", name="qusetion_quiz_index", methods={"GET"})
     */
    public function index(QusetionQuizRepository $qusetionQuizRepository): Response
    {
        return $this->render('qusetion_quiz/index.html.twig', [
            'qusetion_quizzes' => $qusetionQuizRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="qusetion_quiz_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $qusetionQuiz = new QusetionQuiz();
        $form = $this->createForm(QusetionQuizType::class, $qusetionQuiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qusetionQuiz);
            $entityManager->flush();

            return $this->redirectToRoute('qusetion_quiz_index');
        }

        return $this->render('qusetion_quiz/new.html.twig', [
            'qusetion_quiz' => $qusetionQuiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="qusetion_quiz_show", methods={"GET"})
     */
    public function show(QusetionQuiz $qusetionQuiz): Response
    {
        return $this->render('qusetion_quiz/show.html.twig', [
            'qusetion_quiz' => $qusetionQuiz,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="qusetion_quiz_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QusetionQuiz $qusetionQuiz): Response
    {
        $form = $this->createForm(QusetionQuizType::class, $qusetionQuiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('qusetion_quiz_index');
        }

        return $this->render('qusetion_quiz/edit.html.twig', [
            'qusetion_quiz' => $qusetionQuiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="qusetion_quiz_delete", methods={"POST"})
     */
    public function delete(Request $request, QusetionQuiz $qusetionQuiz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qusetionQuiz->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qusetionQuiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('qusetion_quiz_index');
    }

    /**
     * @param QusetionQuizRepository $quiz
     * @return Response
     * @Route("/stats",name="stats",methods={"GET"}))
     */

    public function statistiques(QusetionQuizRepository $quiz): Response
    {
        $Quiz= $quiz->findAll();
        $titreQuestion=[];
        $titreQuiz=[];

        foreach ($Quiz as $qusetion_quizzes){
            $titreQuestion[]=$qusetion_quizzes->getQuestion();
            $titreQuiz[]=count($titreQuiz->$qusetion_quizzes->getQuestion);
        }
        var_dump($Quiz) ;

        return $this->render('qusetion_quiz/stats.html.twig', [
            'titreQuestion'=>json_encode($titreQuestion),
            'titreQuiz'=>json_encode($titreQuiz)
        ]);
    }
}
