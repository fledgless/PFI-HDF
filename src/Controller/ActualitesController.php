<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActualitesController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function index(ArticleRepository $articleRepo): Response
    {
        return $this->render('actualites/index.html.twig', [
            'articles' => $articleRepo->findAll()
        ]);
    }

    #[Route('/actualites/{slug}', name: 'article_show')]
    public function detail(ArticleRepository $articleRepo, string $slug): Response
    {
        $article = $articleRepo->findOneBy(['slug' => $slug]);

        if (!$article) {
            return $this->redirectToRoute('app_actualites');
        }

        return $this->render('actualites/detail.html.twig', [
            'article' => $article
        ]);
    }
}
