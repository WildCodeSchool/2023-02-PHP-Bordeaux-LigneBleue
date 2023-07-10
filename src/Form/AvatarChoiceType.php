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
                'Avatar 1' => 'avatar/man-hindou.png',
                'Avatar 2' => 'avatar/woman-nurse.png',
                'Avatar 3' => 'avatar/woman-indian.png',
                'Avatar 5' => 'avatar/woman-queen.png',
                'Avatar 6' => 'avatar/man-shark.png',
                'Avatar 7' => 'avatar/man-pineapple.png',
                'Avatar 8' => 'avatar/man-cops.png',
                'Avatar 9' => 'avatar/man-cask.png',
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
