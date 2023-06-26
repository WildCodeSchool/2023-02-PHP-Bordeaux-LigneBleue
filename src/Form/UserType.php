<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Femme' => 'homme',
                    'Homme' => 'femme',
                    'Non binaire' => 'non binaire'
                ]
            ])
            ->add('birthday', DateType::class, [
                'years' => range(1900, 2023),])
            ->add('adress')
            ->add('email')
            ->add('password', PasswordType::class, [
                'mapped' => true,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => '********',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
