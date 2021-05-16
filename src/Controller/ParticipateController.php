<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participate;
use App\Form\EvenementType;
use App\Form\ParticipateType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipateController extends AbstractController
{
    /**
     * @Route("/participate", name="participate")
     */
    public function index(): Response
    {
        return $this->render('participate/index.html.twig', [
            'controller_name' => 'ParticipateController',
        ]);
    }
    /**
     * @Route("/event_participate", name="participer")
     */
    public function participate (Request $request,FlashyNotifier $flashy,\Swift_Mailer $mailer){
            $participate= new Participate();
            $participate->setDateparticipate(new \DateTime('now'));
            $form=$this->createForm(ParticipateType::class,$participate);
            $form->add('Save',SubmitType::class);
            $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entity=$this->getDoctrine()->getManager();
            $entity->persist($participate);
            $entity->flush();
            $message = (new \Swift_Message('Affirmation de participation'))
                ->setFrom('salhine.oumayma@gmail.com')
                ->setTo('ahmed.kalai@esprit.tn')
                ->setBody(
                    $this->renderView(
                    // templates/Eventemails/registration.html.twig
                        'Eventemails/registration.html.twig'

                    ),
                    'text/html'
                );
            $flashy->mutedDark('Vous avez été inscrit , un mail d affirmation est envoyéé !!', 'http://your-awesome-link.com');
            $mailer->send($message);
            return $this->redirectToRoute('event_client');
        }

        return $this->render('participate/save.html.twig',[
            'formaj'=>$form->createView()
        ]);

    }





}
