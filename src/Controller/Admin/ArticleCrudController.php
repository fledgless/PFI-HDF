<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Dom\Text;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Date;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre');
        yield SlugField::new('slug')
            ->setTargetFieldName('titre')
            ->hideOnIndex();
        yield TextField::new('soustitre')
            ->hideOnIndex();
        yield TextareaField::new('resume')
            ->hideOnIndex();
        yield TextEditorField::new('contenu')
            ->hideOnIndex();
        yield ChoiceField::new('couleur')
            ->setChoices([
                'Vert' => 'green',
                'Bleu' => 'blue',
                'Jaune' => 'yellow',
            ])
            ->setRequired(true)
            ->setLabel('Couleur de l\'article');
        yield ImageField::new('nomFichierMiniature')
            ->setBasePath('uploads/articles')
            ->setUploadDir('public/uploads/articles')
            ->setLabel('Image miniature');
        yield TextField::new('texteAlternatifMiniature')
            ->hideOnIndex();
        yield DateTimeField::new('createdAt')
            ->hideOnForm();
        yield DateTimeField::new('updatedAt')
            ->hideOnForm();
    }
}
