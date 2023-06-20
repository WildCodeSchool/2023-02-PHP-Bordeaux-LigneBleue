<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TutorialFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $tutorialsPerTheme = 9;

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 0; $j < $tutorialsPerTheme; $j++) {
                $tutorial = new Tutorial();

                $tutorial->setTitle($this->faker->words(2, true));
                $tutorial->setObjective($this->faker->sentence());
                $tutorial->setIsPublished(true);
                $tutorial->setIndexOrder($j + 1);
                $tutorial->setPicturePath("build/images/Fixtures/Pictures/TestPicture.webp");
                $tutorial->setTheme($this->getReference("theme_" . $i));

                $this->addReference("tutorial_" . $i . $j, $tutorial);

                // echo "tutorial_" . $i . $j . "\n";

                $manager->persist($tutorial);
            }
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ThemeFixtures::class];
    }
}
