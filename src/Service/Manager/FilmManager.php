<?php 

namespace App\Service\Manager;

use App\Entity\Film;
use App\Entity\Gender;
use App\Service\ApiTmdbHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class FilmManager
{
    private $kernel;
    private $router;
    private $serializer;
    private $em;

    public function __construct(KernelInterface $kernel, RouterInterface $router, SerializerInterface $serializer, EntityManagerInterface $em )
    {
        $this->kernel = $kernel;
        $this->router = $router;
        $this->serializer = $serializer;
        $this->em = $em;
    }

    public function getFilms(){

        $data = [];
        $request = Request::create($this->router->generate('api_films'), 'GET');
        $response = $this->kernel->handle($request, HttpKernelInterface::SUB_REQUEST);

        $films = json_decode($response->getContent(), true);

        foreach($films['results'] as $key=>$film){
            $json = json_encode($film, true);
            $data[] = $this->serializer->deserialize($json, Film::class, 'json');
        }

        return $data;
    }

    public function getTopRatedFilmsByGender($genderId){

        $data = [];
        $request = Request::create($this->router->generate('api_films_top_rated'), 'GET');
        $response = $this->kernel->handle($request, HttpKernelInterface::SUB_REQUEST);

        $films = json_decode($response->getContent(), true);

        foreach($films['results'] as $key=>$film){

            if(in_array($genderId, $film['genre_ids'])){
                $json = json_encode($film, true);
                $data[] = $this->serializer->deserialize($json, Film::class, 'json');
            }
        }

        return $data;
    }
}