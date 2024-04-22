<?php

namespace App\Controller;

use App\Service\Manager\FilmManager;
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
    public function getFilmsByGenderAction(Request $request, SerializerInterface $serialzier, FilmManager $filmManager, $gender): Response
    {
   
            $films = $filmManager->getTopRatedFilmsByGender($gender);
            $data = $serialzier->serialize($films, JsonEncoder::FORMAT);
            // return new JsonResponse($data, Response::HTTP_OK, [], true);

            return $this->render('home/pages/blocks/films.html.twig', [
                'films' => $films
            ]);
        
    }
}
