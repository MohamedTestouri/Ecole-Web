<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class EventClientController extends AbstractController
{
    /**
     * @Route("/event/client", name="event_client")
     */
    public function index(Request $request,PaginatorInterface $paginator,FlashyNotifier $flashyNotifier): Response
    {
       // $repo=$this->getDoctrine()->getRepository(Evenement::class);
        $donnees= $this->getDoctrine()->getRepository(Evenement::class)->findAll();
      //  $event=$repo->findAll();
        $events=$paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos events)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        // $flashyNotifier->mutedDark('Bienvenus Voila nos evénements!', 'http://your-awesome-link.com');
        return $this->render('event_client/index.html.twig', [
            'eventclients' => $events,
        ]);
    }
 /**
     * @Route("/{id}", name="event_show", methods={"GET"}, requirements={"id"="\d+"})
     *@ParamConverter("id",  options={"id": "id"})
     */
    public function show(Evenement $event): Response
    {
        return $this->render('event_client/show.html.twig', [
            'event' => $event,
        ]);
    }

}
