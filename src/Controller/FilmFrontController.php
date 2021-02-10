<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\CommentFormType;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmFrontController extends AbstractController
{
    /**
     * @Route("api/films", name="api_film_list")
     * @return Response
     */
    public function apiListFilm(FilmRepository $filmRepository) :Response
    {
        return $this->json($filmRepository->findAll(), 200, [], ['groups' => ['film:read']]);
    }
    /**
     * @Route("/", name="film_list")
     */
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        
        return $this->render('film_front/index.html.twig', [
            'films' => $films,
        ]);
    }

    /**
     * @Route("/film/{id}", name="film_detail")
     *
     * @return Response
     */
    public function filmDetail(Film $film)
    {
        $form = $this->createForm(CommentFormType::class);

        return $this->render('film_front/film_detail.html.twig', 
            [
                'film' => $film, 
                'form' => $form->createView()
            ]
        );
    }
}
