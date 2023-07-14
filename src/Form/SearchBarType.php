<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("search", TextType::class, [
                'label' => false,
                'csrf_protection' => false,
                'attr' => [
//                    'class' => 'llb_navbar_search_form js-searchform',
                    'placeholder' => 'Je cherche une formation',
                    'aria-label' => "Search",
                    'type' => "search",
                    'data-model' => "query"
                ],
            ])
            ->setMethod('GET')
            ->setAction("/search/form");
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
