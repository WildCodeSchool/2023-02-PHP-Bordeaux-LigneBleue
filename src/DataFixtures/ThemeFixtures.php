<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ThemeFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->faker = Factory::create();
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $themesAmount = 12;
        for ($i = 1; $i <= $themesAmount; $i++) {
            $theme = new Theme();
            $themeTitle = $this->faker->words(2, true);
            $theme->setTitle($themeTitle);
            $theme->setIndexOrder($i + 1);
            $slug = $this->slugger->slug($themeTitle);
            $theme->setSlug($slug);
            $this->addReference('theme_' . $theme->getTitle(), $theme);
            if ($i < 4) {
                $theme->setCategory($this->getReference('category_Smartphone'));
                $theme->setIconPath('IconPhone . png');
            } elseif ($i > 8) {
                $theme->setCategory($this->getReference('category_Ordinateur'));
                $theme->setIconPath('IconComputer . png');
            } else {
                $theme->setCategory($this->getReference('category_Autres'));
                $theme->setIconPath('IconPrinter . png');
            }
            $this->addReference('theme_' . $i, $theme);
            $manager->persist($theme);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
//
//namespace App\DataFixtures;
//
//use App\Entity\Theme;
//use App\Service\FixturesContent;
//use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Persistence\ObjectManager;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Symfony\Component\String\Slugger\SluggerInterface;
//
//class ThemeFixtures extends Fixture implements DependentFixtureInterface
//{
//    private SluggerInterface $slugger;
//
//    public function __construct(SluggerInterface $slugger)
//    {
//        $this->slugger = $slugger;
//    }
//
//    public function load(ObjectManager $manager): void
//    {
//        foreach (FixturesContent::getThemes() as $theme) {
//            $manager->persist($this->feedThemeObject(
//                $theme["title"],
//                $theme["indexOrder"],
//                $theme["iconPath"],
//                $theme["categoryRef"],
//                $theme["themeRef"]
//            ));
//        }
//
//        $manager->flush();
//    }
//
//    public function getDependencies()
//    {
//        return [CategoryFixtures::class];
//    }
//
//    public function feedThemeObject(
//        string $title,
//        int $indexOrder,
//        string $iconPath,
//        string $categoryRef,
//        string $themeRef
//    ): Theme {
//        $theme = new Theme();
//
//        $theme->setTitle($title);
//        $theme->setIndexOrder($indexOrder);
//        $theme->setSlug($this->slugger->slug($theme->getTitle()));
//        $theme->setIconPath($iconPath);
//        $theme->setCategory($this->getReference($categoryRef));
//        $this->addReference("theme_" . $themeRef . "_" . $theme->getTitle(), $theme);
//
//        return $theme;
//    }
//}
