<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class GITHUBController extends AbstractController
{
    private $githubclient;




    /**
     * @Route("/login/github", name="github")
     */
    public function index(UrlGeneratorInterface $generator): Response
    {
        $url = $generator->generate('front', [], UrlGeneratorInterface::ABSOLUTE_URL);
      return new RedirectResponse("https://github.com/login/oauth/authorize?client_id=$this->githubclient&redirect_url=".$url);
    }
    /**
     * @Route("/front", name="github_front")
     */
    public function front(): Response
    {
        return $this->render('security/github.html.twig');
    }
}
