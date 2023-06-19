<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('ID', 'ID')
            ->onlyOnIndex();
        yield TextField::new('fullName', 'Prénom Nom')
            ->hideOnForm();
        yield TextField::new('firstName', 'Prénom')
            ->onlyOnForms();
        yield TextField::new('lastName', 'Nom')
            ->onlyOnForms();
        yield ChoiceField::new('gender', 'Genre')
        ->setChoices([
            'Femme' => 'femme',
            'Homme' => 'homme',
            'Non binaire' => 'non binaire'
        ]);
        yield DateField::new('birthday', 'Date de naissance');
        yield TextField::new('adress', 'Adresse');
        yield EmailField::new('email', 'Email');
        yield IntegerField::new('level', 'Niveau');
        $roles = ['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_MODERATOR', 'ROLE_USER'];
        yield ChoiceField::new('roles', 'Rôle(s)')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderAsBadges();
        yield DateField::new('createdAt', 'Création')
            ->hideOnForm();
        yield DateField::new('updatedAt', 'Mise à jour')
            ->hideOnForm();
    }
}
