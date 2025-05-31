<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/{slug}', name: 'page_show')]
    public function detail(PageRepository $pageRepo, string $slug): Response
    {
        $page = $pageRepo->findOneBy(['slug' => $slug]);

        if (!$page) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('page/show.html.twig', [
            'page' => $page
        ]);
    }
}
