<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_homepage')]
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Products::class)->findAll();

        return $this->render('products/index.html.twig', [
        'products' => $products
        ]);

    }
}
