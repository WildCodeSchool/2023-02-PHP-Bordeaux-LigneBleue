<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('avatar', ChoiceType::class, [
            'label' => 'Choisissez votre avatar',
            'choices' => [
                'Avatar 1' => 'avatar-lady.png',
                'Avatar 2' => 'avatar-men.png',
                'Avatar 3' => 'avatar-men4.png',
                'Avatar 4' => 'avatar-lady3.png',
                // Ajoutez ici d'autres choix d'avatars
            ],
            'expanded' => true,
            'multiple' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User',
        ]);
    }
}
