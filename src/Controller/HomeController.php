<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Products::class)->findAll();

        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté');
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);


    }
}
