<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;

class PageCrudTest extends WebTestCase 
{
    private $entityManager;

    public function setUp(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $this->entityManager = $client->getContainer()->get('doctrine')->getManager();

        $page = new Page();
        $page->setTitre('Page test');
        $page->setSlug('page-test');
        $page->setResume('Ceci est un test pour l\'entité page.');
        $page->setNomFichierMiniature('test-miniature.jpg');
        $page->setTexteAlternatifMiniature('Miniature de test');
        $page->setContenu("Ceci est un test pour l'entité page.");
        $page->setCategory(
            (new Category())
                ->setNom('home')
        );
      
        $this->entityManager->persist($page);
        $this->entityManager->flush();
    }

    public function testShowPagePage()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $client->request('GET', '/home/page-test');

        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('h1', 'Page test');
    }

    public function testUpdatePage()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        
        // Récupérer la page à mettre à jour
        $page = $this->entityManager->getRepository(Page::class)->findOneBy(['slug' => 'page-test']);
        
        // Mise à jour des propriétés de la page
        $page->setTitre('Page test mise à jour');
        
        // Persister les modifications
        $this->entityManager->flush();

        // Vérifier que la mise à jour a été effectuée
        $client->request('GET', '/home/page-test');
        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('h1', 'Page test mise à jour');
    }

    public function testDeletePage()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        
        // Récupérer la page à supprimer
        $page = $this->entityManager->getRepository(Page::class)->findOneBy(['slug' => 'page-test']);
        
        // Supprimer la page
        $this->entityManager->remove($page);
        $this->entityManager->flush();

        // Vérifier que la page a été supprimée
        $client->request('GET', '/home/page-test');
        $this->assertResponseStatusCodeSame(404);
    }
}