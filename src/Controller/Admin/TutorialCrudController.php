<?php

namespace App\Controller\Admin;

use App\Entity\Tutorial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TutorialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tutorial::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');
        yield SlugField::new('slug', 'Slug')
            ->hideOnIndex()
            ->setTargetFieldName('title')
            ->setUnlockConfirmationMessage('Il est conseillé de laisser ce champs en remplissage automatique.');
        yield TextareaField::new('objective', 'Objectif');
        yield IntegerField::new('indexOrder', 'Ordre');
        yield ImageField::new('picturePath', 'Photo')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/');
        // ->setUploadDir('public/uploads/images');
        yield AssociationField::new('theme', 'Thème');
        yield AssociationField::new('tags', 'Tag(s)');
        yield AssociationField::new('sequences', 'Séquence(s)');
        yield AssociationField::new('quiz', 'Quiz');
        yield BooleanField::new('isPublished', 'Publié');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', 'Formations');
    }
}
