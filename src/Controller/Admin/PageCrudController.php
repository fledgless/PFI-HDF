<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre');
        yield SlugField::new('slug')
            ->setTargetFieldName('titre')
            ->hideOnIndex();
        yield TextEditorField::new('contenu')
            ->hideOnIndex();
        yield ImageField::new('nomFichierMiniature')
            ->setBasePath('uploads/pages')
            ->setUploadDir('public/uploads/pages')
            ->setLabel('Image miniature');
        yield TextField::new('texteAlternatifMiniature')
            ->hideOnIndex();
        yield AssociationField::new('category')
            ->setRequired(true)
            ->setLabel('Catégorie')
            ->setFormTypeOption('choice_label', 'titre')
            ->setFormTypeOption('placeholder', 'Sélectionner une catégorie');
    }
}
