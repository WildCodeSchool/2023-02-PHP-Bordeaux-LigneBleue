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
        $tutorialsAmount = 3;

        $iconsPath = [
            "IconTestComputer.png",
            "IconTestPhone.png",
            "IconTestPrinter.png",
        ];

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 0; $j < $tutorialsAmount; $j++) {
                $tutorial = new Tutorial();

                $tutorial->setTitle($this->faker->word());
                $tutorial->setObjective($this->faker->sentence());
                $tutorial->setIsPublished(true);
                $tutorial->setIndexOrder($j + 1);
                $tutorial->setIconPath("build/images/LogoFixtureTheme/" . $iconsPath[array_rand($iconsPath)]);
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
