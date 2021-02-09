<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmFrontController extends AbstractController
{
    /**
     * @Route("/", name="film_list")
     */
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        dump($films);
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
        return $this->render('film_front/film_detail.html.twig', ['film' => $film]);
    }
}
