<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $this->addFlash('success', 'test success');
        $this->addFlash('danger', 'test danger');
        $this->addFlash('warning', 'test warning');

        return $this->render('default/index.html.twig', []);
    }
}
