<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private SluggerInterface $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {
        $categories = [
            $this->creatCategoryObject("Smartphone", 1, "IconPhone.png"),
            $this->creatCategoryObject("Ordinateur", 1, "IconComputer.png"),
            $this->creatCategoryObject("Autres", 1, "IconPrinter.png")
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function creatCategoryObject(string $categoryName, int $indexOrder, string $iconPath): Category
    {
        $category = new Category();

        $category->setCategoryTitle($categoryName);
        $category->setCategoryIndexOrder($indexOrder + 1);
        $category->setCategoryIconPath($iconPath);
        $slug = $this->slugger->slug($categoryName);
        $category->setSlug($slug);

        $this->addReference("category_" . $category->getCategoryTitle(), $category);

        return $category;
    }
}
