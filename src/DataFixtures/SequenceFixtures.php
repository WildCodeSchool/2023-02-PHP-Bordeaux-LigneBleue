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
        $sequences = FixturesContent::getAllSequencesContent();
        $sequences = array_map([$this, 'feedSequenceObject'], $sequences);
        array_walk($sequences, [$manager, 'persist']);

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
}
