<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ThemeFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $themesAmount = 12;

        for ($i = 0; $i < $themesAmount; $i++) {
            $theme = new Theme();

            $theme->setTitle($this->faker->word());
            $theme->setIndexOrder($i + 1);
            $theme->setIconPath("test/test.png");

            $this->addReference("theme_" . $theme->getTitle(), $theme);
            $manager->persist($theme);
        }


        $manager->flush();
    }
}
