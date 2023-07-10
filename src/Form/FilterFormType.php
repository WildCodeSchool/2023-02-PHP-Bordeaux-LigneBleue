<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Repository\CategoryRepository;
use App\Twig\Components\CategoryComponent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFormType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $builder
            ->add("Complete", CheckboxType::class, [
                "required" => false,
                "label_attr" => [
                    "class" => "form-check-label",
                    "for" => "flexSwitchCheckDefault",
                    "style" => "color: white"
                ],
                "attr" => [
                    "class" => "form-check-input",
                    'type' => "checkbox",
                    'role' => "switch",
                    "id" => "flexSwitchCheckDefault"
                ]
            ])
            ->add("Favoris", CheckboxType::class, [
                "required" => false,
                "label_attr" => [
                    "class" => "form-check-label",
                    "for" => "flexSwitchCheckDefault",
                    "style" => "color: white"
                ],
            ])
            ->add("Category", EntityType::class, [
                "class" => Category::class,
                "placeholder" => "Categories",
                "required" => false,
                "attr" => [
                    "class" => "btn btn-secondary dropdown-toggle",
                    "role" => "button",
                    "id" => "dropdownMenuLink",
                    "data-toggle" => "dropdown",
                    "aria-haspopup" => "true",
                    "aria-expanded" => "false"
                ],
                "choice_label" => "categoryTitle",
                "choice_attr" => function () {
                    return ["class" => "dropdown-item"];
                }
            ])
            ->add("Theme", EntityType::class, [
                "class" => Theme::class,
                "choice_label" => "title",
                "placeholder" => "Theme",
                "required" => false
            ])
            ->add("Tag", EntityType::class, [
                "class" => Tag::class,
                "choice_label" => "title",
                "placeholder" => "Tag",
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
