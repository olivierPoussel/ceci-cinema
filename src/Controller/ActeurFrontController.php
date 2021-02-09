<?php

namespace App\Controller;

use App\Entity\Acteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActeurFrontController extends AbstractController
{
    /**
     * @Route("/acteur/{id}", name="acteur_detail")
     */
    public function index(Acteur $acteur): Response
    {
        return $this->render('acteur_front/index.html.twig', [
            'acteur' => $acteur,
        ]);
    }
}
