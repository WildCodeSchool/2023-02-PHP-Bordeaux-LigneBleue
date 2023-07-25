<?php

namespace App\DataFixtures;

use App\Entity\Sequence;
use App\DataFixtures\TutorialFixtures;
use App\Service\FixturesContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SequenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (FixturesContent::getAllSequencesContent() as $tutorialData) {
            $manager->persist($this->feedSequenceObject($tutorialData));
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TutorialFixtures::class];
    }

    public function feedSequenceObject(array $tutorialData): Sequence
    {
        $sequence = new Sequence();

        $sequence->setTitle($tutorialData["title"]);
        $sequence->setContent($tutorialData["content"]);
        $sequence->setExercice($tutorialData["exercice"]);
        $sequence->setIndexOrder($tutorialData["indexOrder"]);
        $sequence->setPicturePath($tutorialData["picturePath"]);
        $sequence->setTutorial($this->getReference($tutorialData["tutorialRef"]));

        return $sequence;
    }


            // for ($i = 1; $i <= 12; $i++) {
        //     for ($j = 0; $j < 9; $j++) {
        //         for ($k = 1; $k <= $sequencesPerTutorial; $k++) {
        //             $sequence = new Sequence();
        //             $sequence->setTitle('tuto' . $i . $j . "_sequence" . $k);
        //             $sequence->setContent($this->faker->paragraph(30));
        //             $sequence->setExercice(false);
        //             $sequence->setIndexOrder($k);
        //             $sequence->setPicturePath("mbl-sms.jpg");
        //             $sequence->setTutorial($this->getReference("tutorial_" . $i . $j));

        //             $manager->persist($sequence);
        //             $sequences[] = $sequence;
        //         }
        //     }
        // }
}
