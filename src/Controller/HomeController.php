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

        $em = $this->getDoctrine()->getManager(); //connexion db

        $products = $em->getRepository(Products::class)->findAll(); //all products in db

        $product = new Products(); // new product for admin
        $form = $this->createForm(ProductsType::class, $product); //form ProductType
        $form->handleRequest($request); //requete http

        if ($form->isSubmitted() && $form->isValid()) {

            $productImage = $form->get('image')->getData(); //image du form

            if ($productImage) { //si une image est upload

                $newFilename = uniqid().'.'.$productImage->guessExtension(); //renommage

                try { //deplacer l'image sur le server
                    $productImage->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) { // si une erreur

                    $this->addFlash("danger", "Une erreur est survenue");

                }
                $product->setImage($newFilename); //image uplaod to product
            }

            $em->persist($product); //prepare
            $em->flush(); //exec

            $this->addFlash('success', 'Produit ajouté');

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'product' => $product,
            'form' => $form->createView(),
        ]);


    }
}
