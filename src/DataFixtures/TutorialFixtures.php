<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class TutorialFixtures extends Fixture implements DependentFixtureInterface
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
        $tutorialsPerTheme = 9;

        $tagReferences = [
            "tag_Débutant",
            "tag_Intermédiaire",
            "tag_Avancé"
        ];

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 0; $j < $tutorialsPerTheme; $j++) {
                $tutorial = new Tutorial();

                $tutorialTitle = $this->faker->words(2, true);
                $tutorial->setTitle($tutorialTitle);
                $tutorial->setObjective($this->faker->sentence());
                $tutorial->setIsPublished(true);
                $tutorial->setIndexOrder($j + 1);
                $tutorial->setPicturePath("build/images/Fixtures/Pictures/TestPicture.webp");
                $tutorial->setTheme($this->getReference("theme_" . $i));

                $tutorial->addTag($this->getReference($tagReferences[array_rand($tagReferences)]));
                $slug = $this->slugger->slug($tutorialTitle);
                $tutorial->setSlug($slug);

                $this->addReference("tutorial_" . $i . $j, $tutorial);


                $manager->persist($tutorial);
            }
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
}
