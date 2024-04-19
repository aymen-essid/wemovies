<?php

namespace App\Controller\Api;

use ApiTmdbHandler;
use App\Entity\Film;
use App\Service\ApiTmdbHandler as ServiceApiTmdbHandler;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/api', name: 'app_')]
class ApiController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ObjectRepository */
    private $objectRepository;

    private $client;

    private $apiHandler;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $client, ServiceApiTmdbHandler $apiHandler)
    {
        $this->apiHandler = $apiHandler;
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Film::class);
    }

    #[Route('/films', name: 'api_films')]
    public function getFilmsFromTmdb(Request $request)
    {
        
        dd($this->apiHandler->auth());
        
        // $path = '/jokes/random/';
        // $response = $this->client->request('GET', $path, [
        //     'query' => [
        //         'limitTo' => '[nerdy]',
        //         'escape' => 'javascript',
        //     ],
        // ]);
    }

    #[Route('/filmsxxx', name: 'api_filmxxx')]
    public function postFilm(Request $request): View
    {
        $film = new Film();
        $film->setName($request->get('name'));
        $film->setDescription($request->get('description'));
        $film->setProducer($request->get('producer'));
        $film->setSource($request->get('source'));
        $film->setYear($request->get('year'));
        $film->setGender($request->get('gender'));

        $this->entityManager->persist($film);
        $this->entityManager->flush();

        return View::create($film, Response::HTTP_CREATED);
    }

}
