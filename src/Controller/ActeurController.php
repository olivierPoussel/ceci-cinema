<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\Acteur1Type;
use App\Repository\ActeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acteur")
 */
class ActeurController extends AbstractController
{
    /**
     * @Route("/", name="acteur_index", methods={"GET"})
     */
    public function index(ActeurRepository $acteurRepository): Response
    {
        return $this->render('acteur/index.html.twig', [
            'acteurs' => $acteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="acteur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $acteur = new Acteur();
        $form = $this->createForm(Acteur1Type::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acteur);
            $entityManager->flush();

            return $this->redirectToRoute('acteur_index');
        }

        return $this->render('acteur/new.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acteur_show", methods={"GET"})
     */
    public function show(Acteur $acteur): Response
    {
        return $this->render('acteur/show.html.twig', [
            'acteur' => $acteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="acteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acteur $acteur): Response
    {
        $form = $this->createForm(Acteur1Type::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acteur_index');
        }

        return $this->render('acteur/edit.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Acteur $acteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acteur_index');
    }
}
