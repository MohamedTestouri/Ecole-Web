<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function searchStudentx(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(TagRepository::class);
        $requestString=$request->get('searchValue');
        $students = $repository->findStudentByNsc($requestString);
        $jsonContent = $Normalizer->normalize($students, 'json',['groups'=>'Tag:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }

}
