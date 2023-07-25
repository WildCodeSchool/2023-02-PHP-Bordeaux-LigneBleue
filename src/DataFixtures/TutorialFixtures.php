<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use App\Service\FixturesContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class TutorialFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (FixturesContent::getAllTutorialsContent() as $tutorial) {
            $manager->persist($this->feedTutorialObject($tutorial));
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ThemeFixtures::class,
            TagFixtures::class
        ];
    }

    public function feedTutorialObject(array $tutorialData): Tutorial
    {
        $tutorial = new Tutorial();

        $tutorial->setTitle($tutorialData["title"]);
        $tutorial->setObjective($tutorialData["objective"]);
        $tutorial->setIsPublished($tutorialData["isPublished"]);
        $tutorial->setIndexOrder($tutorialData["indexOrder"]);
        $tutorial->setPicturePath($tutorialData["picturePath"]);
        $tutorial->setTheme($this->getReference($tutorialData["themeRef"]));
        $tutorial->addTag($this->getReference($tutorialData["tagRef"]));
        $tutorial->setSlug($this->slugger->slug($tutorial->getTitle()));
        $this->addReference("tutorial_" . $tutorialData["tutorialRef"], $tutorial);
        // echo "tutorial_" . $tutorialData["tutorialRef"] . "\n";

        return $tutorial;
    }
}
