<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre');
        yield TextField::new('slug');
        yield TextEditorField::new('contenu')->hideOnIndex();
        yield ImageField::new('nomFichierMiniature')
            ->setBasePath('uploads/articles')
            ->setUploadDir('public/uploads/articles')
            ->setLabel('Image miniature');
        yield TextField::new('texteAlternatifMiniature')->hideOnIndex();
    }
}
