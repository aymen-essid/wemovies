<?php 

namespace App\Service\Manager;

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

class GenderManager
{
    private $apiHandler;
    private $kernel;
    private $router;
    private $serializer;
    private $em;

    public function __construct( ApiTmdbHandler $apiHandler, KernelInterface $kernel, RouterInterface $router, SerializerInterface $serializer, EntityManagerInterface $em )
    {
        $this->apiHandler = $apiHandler;
        $this->kernel = $kernel;
        $this->router = $router;
        $this->serializer = $serializer;
        $this->em = $em;
    }

    public function getGenders(){

        $data = [];
        $request = Request::create($this->router->generate('api_genders'), 'GET');
        $response = $this->kernel->handle($request, HttpKernelInterface::SUB_REQUEST);

        $genders = json_decode($response->getContent(), true);

        foreach($genders['genres'] as $key=>$gender){
            $json = json_encode($gender, true);
            $genderObj = $this->serializer->deserialize($json, Gender::class, 'json');
            $genderObj->setId($gender['id']);
            $data[] = $genderObj;
        }

        return $data;
    }

    public function getGenderNameById(int $genderId):string
    {

        $genderName = "";
        $genders = $this->getGenders();
        foreach($genders as $gender){
            if($gender->getId() == $genderId){
                $genderName = $gender->getName();
                break;
            }      
        }
        return $genderName;
    }
    
    // public function syncGenders(){

    //     $request = Request::create($this->router->generate('app_api_genders'), 'GET');
    //     $response = $this->kernel->handle($request, HttpKernelInterface::SUB_REQUEST);

    //     $genders = json_decode($response->getContent(), true);

    //     foreach($genders['genres'] as $key=>$gender){
    //         $json = json_encode($gender, true);
    //         $newGender = $this->deserialize($json, Gender::class);
    //         $this->em->persist($newGender);
    //     }
    //     $this->em->flush();

    // }

}