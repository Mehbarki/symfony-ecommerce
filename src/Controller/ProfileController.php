<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */    public function index(Request $request): Response
    {
        $user = $this->getUser();

        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mysqli = $this->getDoctrine()->getManager();
            // Je prépare la sauvegarde
            $mysqli->persist($user);
            // J'execute la sauvegarde
            $mysqli->flush();

            $this->addFlash('success', 'Compte modifié !');

        }

        $lastCommands = $this->getDoctrine()->getManager()->getRepository(Shop::class)->findAll();

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
            'commands' => $lastCommands
        ]);

    }
}
