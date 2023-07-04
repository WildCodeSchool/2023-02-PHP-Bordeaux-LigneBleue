<?php

namespace App\Controller\Admin;

use App\Entity\Sequence;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SequenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sequence::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');
        yield TextareaField::new('content', 'Contenu');
        yield IntegerField::new('exercice', 'Exercice');
        yield IntegerField::new('indexOrder', 'Ordre');
        yield ImageField::new('picturePath', 'Photo')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/');
        // ->setUploadDir('public/uploads/images');
        yield AssociationField::new('tutorial', 'Formation');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', 'Séquences');
    }
}
