<?php

namespace App\Controller;

use App\Entity\ShopContent;
use App\Form\ShopContentType;
use App\Repository\ShopContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop/content')]
class ShopContentController extends AbstractController
{
    #[Route('/', name: 'shop_content_index', methods: ['GET'])]
    public function index(ShopContentRepository $shopContentRepository): Response
    {
        return $this->render('shop_content/index.html.twig', [
            'shop_contents' => $shopContentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'shop_content_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $shopContent = new ShopContent();
        $form = $this->createForm(ShopContentType::class, $shopContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shopContent);
            $entityManager->flush();

            return $this->redirectToRoute('shop_content_index');
        }

        return $this->render('shop_content/new.html.twig', [
            'shop_content' => $shopContent,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'shop_content_show', methods: ['GET'])]
    public function show(ShopContent $shopContent): Response
    {
        return $this->render('shop_content/show.html.twig', [
            'shop_content' => $shopContent,
        ]);
    }

    #[Route('/{id}/edit', name: 'shop_content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShopContent $shopContent): Response
    {
        $form = $this->createForm(ShopContentType::class, $shopContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop_content_index');
        }

        return $this->render('shop_content/edit.html.twig', [
            'shop_content' => $shopContent,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'shop_content_delete', methods: ['DELETE'])]
    public function delete(Request $request, ShopContent $shopContent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shopContent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shopContent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shop_content_index');
    }
}
