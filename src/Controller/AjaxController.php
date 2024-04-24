<?php

namespace App\Controller;

use App\Service\Manager\FilmManager;
use App\Service\Manager\GenderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/ajax', name: 'app_ajax_')]
class AjaxController extends AbstractController
{

    #[Route('/{gender}/films', name: 'films_by_gender', methods: ['GET'])]
    public function getFilmsByGenderAction(Request $request, SerializerInterface $serialzier, FilmManager $filmManager, GenderManager $genderManager, $gender): Response
    {

        $films = $filmManager->getTopRatedFilmsByGender($gender);
        $genderName = $genderManager->getGenderNameById($gender);

        return $this->render('home/pages/blocks/film.html.twig', [
            'films' => $films,
            'genderName' => $genderName
        ]);    
    }

    #[Route('/films', name: 'films_search', methods: ['GET'])]
    public function searchFilmAction(Request $request, SerializerInterface $serialzier, FilmManager $filmManager, GenderManager $genderManager)
    {
        #return json data
        // $jsonData = $filmManager->getFilmsForSearch();
        // return $jsonData;
        
        return new JsonResponse($filmManager->getFilmsForSearch(), '200', [], true);
    }
}
