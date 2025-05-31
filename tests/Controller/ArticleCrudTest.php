<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Model\TimeStampInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

class ArticleCrudTest extends WebTestCase 
{
    private $entityManager;

    public function setUp(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $this->entityManager = $client->getContainer()->get('doctrine')->getManager();

        $article = new Article();
        $article->setTitre('Article test');
        $article->setSlug('article-test');
        $article->setSoustitre('Sous-titre de l\'article test');
        $article->setCouleur('green');
        $article->setResume('Ceci est un test pour l\'entité article.');
        $article->setNomFichierMiniature('test-miniature.jpg');
        $article->setTexteAlternatifMiniature('Miniature de test');
        $article->setContenu("Ceci est un test pour l'entité article.");
        $article->setCreatedAt(new \DateTime());
      
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }

    public function testShowArticlePage()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $client->request('GET', '/actualites/article-test');

        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('h1', 'Article test');
    }

    public function testUpdateArticle()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        
        // Récupérer l'article à mettre à jour
        $article = $this->entityManager->getRepository(Article::class)->findOneBy(['slug' => 'article-test']);
        
        // Mise à jour des propriétés de l'article
        $article->setTitre('Article test mis à jour');
        
        // Persister les modifications
        $this->entityManager->flush();

        // Vérifier que la mise à jour a été effectuée
        $client->request('GET', '/actualites/article-test');
        
        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('h1', 'Article test mis à jour');
    }

    public function testDeleteArticle()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        
        // Récupérer l'article à supprimer
        $article = $this->entityManager->getRepository(Article::class)->findOneBy(['slug' => 'article-test']);
        
        // Supprimer l'article
        $this->entityManager->remove($article);
        $this->entityManager->flush();

        // Vérifier que l'article n'existe plus
        $client->request('GET', '/actualites/article-test');
        
        $this->assertResponseStatusCodeSame(404); // L'article devrait renvoyer une erreur 404
    }
}