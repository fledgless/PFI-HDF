<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase 
{
    public function testPageEntity()
    {
        $page = new Page();
        $page->setTitre('Page test');
        $page->setSlug('page-test');
        $page->setResume("Ceci est un test pour l'entité page.");
        $page->setNomFichierMiniature('test-miniature.jpg');
        $page->setTexteAlternatifMiniature('Miniature de test');
        $page->setContenu("Ceci est un test pour l'entité page.");
        $page->setCategory(new Category()->setNom('Home'));

        $this->assertSame('Page test', $page->getTitre());
        $this->assertSame('page-test', $page->getSlug());
        $this->assertSame("Ceci est un test pour l'entité page.", $page->getResume());
        $this->assertSame('test-miniature.jpg', $page->getNomFichierMiniature());
        $this->assertSame('Miniature de test', $page->getTexteAlternatifMiniature());
        $this->assertSame("Ceci est un test pour l'entité page.", $page->getContenu());
        $this->assertSame('Home', $page->getCategory()->getNom());
    }
}