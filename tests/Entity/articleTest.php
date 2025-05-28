<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase 
{
    public function testPageEntity()
    {
        $article = new Article();
        $article->setTitre('Article test');
        $article->setSlug('article-test');
        $article->setSoustitre('Sous-titre de l\'article test');
        $article->setCouleur('green');
        $article->setResume('Ceci est un test pour l\'entité article.');
        $article->setNomFichierMiniature('test-miniature.jpg');
        $article->setTexteAlternatifMiniature('Miniature de test');
        $article->setContenu("Ceci est un test pour l'entité article.");

        $this->assertSame('Article test', $article->getTitre());
        $this->assertSame('article-test', $article->getSlug());
        $this->assertSame('Sous-titre de l\'article test', $article->getSoustitre());
        $this->assertSame('green', $article->getCouleur());
        $this->assertSame('Ceci est un test pour l\'entité article.', $article->getResume());
        $this->assertSame('test-miniature.jpg', $article->getNomFichierMiniature());
        $this->assertSame('Miniature de test', $article->getTexteAlternatifMiniature());
        $this->assertSame("Ceci est un test pour l'entité article.", $article->getContenu());
    }
}