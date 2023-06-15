<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ThemeFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $themesAmount = 12;

        $iconsPath = [
            "IconTestComputer.png",
            "IconTestPhone.png",
            "IconTestPrinter.png",
        ];

        for ($i = 0; $i < $themesAmount; $i++) {
            $theme = new Theme();

            $theme->setTitle($this->faker->word());
            $theme->setIndexOrder($i + 1);
            $theme->setIconPath("build/images/LogoFixtureTheme/" . $iconsPath[array_rand($iconsPath)]);
            $theme->setCategory($this->getReference("category_Smartphone"));

            $this->addReference("theme_" . $theme->getTitle(), $theme);
            $manager->persist($theme);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
