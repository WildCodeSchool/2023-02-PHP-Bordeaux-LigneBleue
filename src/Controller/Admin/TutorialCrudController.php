<?php

namespace App\Controller\Admin;

use App\Entity\Tutorial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
        yield TextField::new('categoryTitle', 'Titre');
        yield TextareaField::new('objective', 'Objectif');
        yield IntegerField::new('indexOrder', 'Ordre');
        yield TextField::new('picturePath', 'Photo');
        yield TextField::new('iconPath', 'Icône');
        yield AssociationField::new('theme', 'Thème');
        yield BooleanField::new('isPublished', 'Publié');
    }
}
