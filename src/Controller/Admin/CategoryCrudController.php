<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('categoryTitle', 'Titre');
        yield SlugField::new('slug', 'Slug')
            ->hideOnIndex()
            ->hideWhenUpdating()
            ->setTargetFieldName('categoryTitle');
        yield IntegerField::new('categoryIndexOrder', 'Ordre');
        yield ImageField::new('categoryIconPath', 'Icône')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->setBasePath('uploads/icones')
            ->setUploadDir('public/uploads/icones');
        yield AssociationField::new('themes', 'Thème(s)')
            ->hideWhenCreating();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', 'Catégories');
    }
}
