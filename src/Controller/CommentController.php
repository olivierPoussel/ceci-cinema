<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Film;
use App\Entity\User;
use App\Form\CommentFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/film/{id}", name="comment", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function index(Film $film, Security $security, Request $request)
    {
        $user = $security->getUser();

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment
            ->setFilm($film)
            ->setUser($user)
            ;
            $em =  $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Votre commentaire a bien été enregistré');

            return $this->redirectToRoute('film_detail', ['id' => $film->getId()]);
        }else {
            $this->addFlash('danger', 'Erreur lors de l\'enregistrement de votre commentaire');
        }
        
        return $this->render('film_front/film_detail.html.twig', 
            [
                'film' => $film, 
                'form' => $form->createView()
            ]
        );
    }
}
