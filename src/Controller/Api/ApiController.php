<?php

namespace App\Controller\Api;

// use App\Entity\Film;
use App\Entity\Gender;
use App\Service\ApiTmdbHandler as ServiceApiTmdbHandler;
use App\Service\Manager\FilmManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private ObjectRepository $objectRepository;

    private ServiceApiTmdbHandler $apiHandler;

    private SerializerInterface $serializer;


    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer ,ServiceApiTmdbHandler $apiHandler)
    {
        $this->apiHandler = $apiHandler;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        // $this->objectRepository = $this->entityManager->getRepository(Film::class);
    }

    #[Route('/genders', name: 'genders', methods: ['GET'])]
    public function getAllGendersFromTmdb(Request $request)
    {
        $response =   $this->apiHandler->execApiQuery('GET', 'genre/movie/list' );

        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }

    #[Route('/films', name: 'films', methods: ['GET'])]
    public function getAllFilmsFromTmdb(Request $request)
    {
        $response = $this->apiHandler->execApiQuery('GET', 'discover/movie' );

        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }

    #[Route('/films/top-rated', name: 'films_top_rated', methods: ['GET'])]
    public function getTopRatedFilmsFromTmdb(Request $request)
    {
        $response = $this->apiHandler->execApiQuery('GET', 'movie/top_rated?language=en-US&page=1');

        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }

    #[Route('/{gender}/films', name: 'films_top_rated_by_gender', methods: ['GET'])]
    public function getTopRatedFilmsFromTmdbByGender(Request $request, $gender)
    {
        $response = $this->apiHandler->execApiQuery('GET', 'movie/top_rated?language=en-US&page=1');
        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }
    
    #[Route('/{film}/poster', name: 'film_poster', methods: ['GET'])]
    public function getPosterByFilm(Request $request, $film)
    {
        $response = $this->apiHandler->execApiQuery('GET', 'movie/'. $film .'/images');
        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }

    #[Route('/{film}/video', name: 'film_video', methods: ['GET'])]
    public function getVideoByFilmId(Request $request, $film)
    {
        $response = $this->apiHandler->execApiQuery('GET', 'movie/'. $film . '/watch/providers');
        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);

    }
    
    public function syncDbFromApi(){

        $gendres = $this->apiHandler->execApiQuery('GET', 'genre/movie/list' );
        $films = $this->apiHandler->execApiQuery('GET', 'discover/movie' );

        $data = ['gender' => $gendres, 'films' => $films];

        return $data;
    }


}
