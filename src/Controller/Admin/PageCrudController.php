<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pages')
            ->setEntityLabelInSingular('Page')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des pages')
            ->setPageTitle(Crud::PAGE_EDIT, 'Édition de la page')
            ->setPageTitle(Crud::PAGE_NEW, 'Création d\'une nouvelle page');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre');
        yield SlugField::new('slug')
            ->setTargetFieldName('titre')
            ->hideOnIndex();
        yield TextEditorField::new('contenu')
            ->hideOnIndex()
            ->setTrixEditorConfig([
                'blockAttributes' => [
                    'heading1' => ['tagName' => 'h2'],
                ],
            ]);
        yield ImageField::new('nomFichierMiniature')
            ->setBasePath('uploads/pages')
            ->setUploadDir('public/uploads/pages')
            ->setLabel('Image miniature');
        yield TextField::new('texteAlternatifMiniature')
            ->hideOnIndex();
        yield AssociationField::new('category')
            ->setRequired(true)
            ->setLabel('Catégorie')
            ->setFormTypeOption('choice_label', 'nom')
            ->setFormTypeOption('placeholder', 'Sélectionner une catégorie');
    }
}
