<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('prompt', 'Intitulé');
        yield TextField::new('proposition1', 'Proposition 1');
        yield TextField::new('proposition2', 'Proposition 2');
        yield TextField::new('proposition3', 'Proposition 3');
        yield TextField::new('proposition4', 'Proposition 4');
        yield TextField::new('answer', 'Réponse');
        yield AssociationField::new('quiz', 'Quiz associé');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle('index', 'Questions');
    }
}
