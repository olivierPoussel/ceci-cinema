<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\ActeurType;
use App\Repository\ActeurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActeurOriginController extends AbstractController
{
    /**
     * @Route("/", name="index_acteur")
     *
     * @return Response
     */
    public function indexActeur(ActeurRepository $repo)
    {
        $acteurList = $repo->findAll();

        return $this->render('acteurs.html.twig', [
            'acteurs' => $acteurList,
            'titleFromController' => 'Liste Acteurs'
        ]);
    }

    /**
     * @Route("/acteur/create", name="create_acteur")
     *
     * @return Response
     */
    public function createActeur(Request $request)
    {
        $acteur = new Acteur();
        $form = $this->createForm(ActeurType::class, $acteur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acteur);
            $em->flush();

            return $this->redirectToRoute('index_acteur');
        }

        return $this->render('acteur_form.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
