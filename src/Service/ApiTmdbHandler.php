<?php

namespace App\Service;

use ApiPlatform\Metadata\Exception\HttpExceptionInterface;
use Exception;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface as ExceptionHttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiTmdbHandler {

    private $httpClient;
    private $connexion;
    private $api_uri;
    private $api_key;
    private $api_token;

    public function __construct(HttpClientInterface $client, $api_uri, $api_key, $api_token) {
        $this->httpClient = $client;
        $this->api_uri = $api_uri;
        $this->api_key = $api_key;
        $this->api_token = $api_token;

        $this->auth();
        $this->connect();
    }

    private function connect(){

        try {
            $response = $this->httpClient->request('GET', $this->api_uri);
            
            //if status code is not 200 throw exception
            if ($response->getStatusCode() !== 200) {
              throw new \Exception('Error: '.$response->getStatusCode());
            }
            
            return $content = $response->getContent(); //get the content
          }
          catch(TransportException $e) {
            // handle network problems
            echo "Network Error: " . $e->getMessage();
          }
          catch(ExceptionHttpExceptionInterface $e) {
            // handle 4xx and 5xx http errors
            echo "HTTP Error: " . $e->getMessage();
          }
          catch(Exception $e) {
            // handle other types of errors
            echo "General Error: " . $e->getMessage();
          }
    }


    public function auth()
    {

        return $this->httpClient->withOptions([
            'base_uri' => $this->api_uri,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_token,
                'accept' => 'application/json'
            ],
            'extra' => ['api-key' => $this->api_key],
        ]);
    }

}