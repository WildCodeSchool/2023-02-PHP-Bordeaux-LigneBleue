<?php

namespace App\Controller\Admin;

use App\Entity\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Theme::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');
        yield IntegerField::new('indexOrder', 'Ordre');
        yield ImageField::new('iconPath', 'Icône')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->setBasePath('uploads/icones')
            ->setUploadDir('public/uploads/icones');
        yield AssociationField::new('category', 'Catégorie');
        yield AssociationField::new('tutorials', 'Formation(s)')
            ->hideWhenCreating();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', 'Thèmes');
    }
}
