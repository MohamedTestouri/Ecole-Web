<?php


namespace App\github;
use App\Entity\Users;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class GithubProvider
{
    private $githubclient;
    private $githubid;
    private $HttpClient;

    /**
     * GithubProvider constructor.
     * @param $githubclient
     * @param $githubid
     * @param $HttpClient
     */
    public function __construct($githubclient, $githubid,HttpClientInterface $HttpClient)
    {
        $this->githubclient = $githubclient;
        $this->githubid = $githubid;
        $this->HttpClient = $HttpClient;
    }
    public function loaduserfrongit(String $code){
        $url = sprintf("https://github.com/login/oauth/access_token?client_id=%s&client_secret=%s&code=%s",
            $this->githubclient, $this->githubid, $code);

        $response = $this->HttpClient->request('POST', $url, [
            'headers' => [
                'Accept' => "application/json"
            ]
        ]);
       $token= $response->ToArray()['access_token'];

        $response = $this->HttpClient->request('GET', 'https://api.github.com/user', [
            'headers' => [
                'Authorization' => 'token '.$token
            ]
        ]);

        $data = $response->toArray();
        return new Users($data);

    }


}