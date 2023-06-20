<?php

namespace App\DataFixtures;

use App\Entity\Sequence;
use App\DataFixtures\TutorialFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class SequenceFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $sequencesPerTutorial = 5;

        $sequences = [];

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 0; $j < 9; $j++) {
                for ($k = 1; $k <= $sequencesPerTutorial; $k++) {
                    $sequence = new Sequence();

                    $sequence->setTitle($this->faker->words(3, true));
                    $sequence->setContent($this->faker->paragraph(30));
                    $sequence->setExercice(false);
                    $sequence->setIndexOrder($k);
                    $sequence->setPicturePath("build/images/mbl-sms.jpg");
                    $sequence->setTutorial($this->getReference("tutorial_" . $i . $j));


                    $manager->persist($sequence);
                    $sequences[] = $sequence;
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TutorialFixtures::class];
    }
}
