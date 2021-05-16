<?php

namespace App\Controller;

use App\Entity\CatEvent;
use App\Form\CatEventType;
use App\Repository\CatEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatEventController extends AbstractController
{
    /**
     * @Route("/cat/event", name="cat_event")
     */
    public function index(): Response
    {
        return $this->render('cat_event/index.html.twig', [
            'controller_name' => 'CatEventController',
        ]);
    }

    /**
     * @param CatEventRepository $rep
     * @return Response
     * @Route ("/CatEvent/Affichage",name="CatAffiche")
     */
    public function list(CatEventRepository $rep)
    {
        $pro=$rep->OrderByAlphabet();
        return $this->render('cat_event/list.html.twig',['tab'=>$pro]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/cat_event/Ajouter",name="Cat_ajout")
     */
    public function aj(Request $request)
    {
        $cat= new CatEvent();
        $form=$this->createForm(CatEventType::class,$cat);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entity=$this->getDoctrine()->getManager();
            $entity->persist($cat);
            $entity->flush();
            return $this->redirectToRoute('CatAffiche');
        }
        return $this->render('cat_event/add.html.twig',[
            'formaj'=>$form->createView()
        ]);

    }

    /**
     * @param $id
     * @param CatEventRepository $rep
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/cat_event/Supprimer/{id}",name="Cat_supp")
     */

    public function supp($id,CatEventRepository $rep)
    {
        $cat=$rep->find($id);
        $entity=$this->getDoctrine()->getManager();
        $entity->remove($cat);
        $entity->flush();
        return $this->redirectToRoute('CatAffiche');
    }

    /**
     * @param $id
     * @param CatEventRepository $rep
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/cat_event/Modifier/{id}",name="Cat_update")
     */
    public function updateCat ($id,CatEventRepository $rep, Request $request)
    {
        $rec=$rep->find($id);
        $form=$this->createForm(CatEventType::class,$rec);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entity=$this->getDoctrine()->getManager();
            $entity->flush();
            return $this->redirectToRoute('CatAffiche');
        }
        return $this->render('cat_event/update.html.twig',[
            'fup'=> $form->createView()
        ]);

    }

    /**
     * @param CatEventRepository $rep
     * @param Request $request
     * @return Response
     * @Route("/cat_event/search",name="Cat_search")
     */
    public function search_byname(CatEventRepository $rep, Request $request){
        $info=$request->get('search');
        $cat= $rep->findBy(['libelle'=>($info)]);
        return $this->render('cat_event/list.html.twig',['tab'=>$cat]);
    }
}
