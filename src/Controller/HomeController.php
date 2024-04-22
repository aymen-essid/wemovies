<?php

namespace App\Controller;

use App\Service\Manager\FilmManager;
use App\Service\Manager\GenderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(GenderManager $genderManager, FilmManager $filmManager): Response
    {

        $genders = $genderManager->getGenders();
        $films = $filmManager->getFilms();

        return $this->render('home/pages/home.html.twig', [
            'genders' => $genders,
            'films' => $films
        ]);
    }















    #[Route('/sync', name: 'app_sync')]
    public function syncDataFromApi(Request $request, GenderManager $genderManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('syncForm', SubmitType::class, [
                'attr' => ['label' => 'Sync Data']
            ])
            ->getForm();

        $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
            
        //     $genderManager->syncGenders();
        // }

        return $this->render('home/pages/sync.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
