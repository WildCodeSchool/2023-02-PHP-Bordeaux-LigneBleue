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

        $iconsPath = [
            "IconTestComputer.png",
            "IconTestPhone.png",
            "IconTestPrinter.png",
        ];

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 0; $j < $tutorialsPerTheme; $j++) {
                $tutorial = new Tutorial();

                $tutorial->setTitle($this->faker->word());
                $tutorial->setObjective($this->faker->sentence());
                $tutorial->setIsPublished(true);
                $tutorial->setIndexOrder($j + 1);
                $tutorial->setPicturePath("build/images/Fixtures/Pictures/TestPicture.webp");
                $tutorial->setIconPath("build/images/Fixtures/CardIcons/" . $iconsPath[array_rand($iconsPath)]);
                $tutorial->setTheme($this->getReference("theme_" . $i));

                $this->addReference("tutorial_" . $i . $j, $tutorial);

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
