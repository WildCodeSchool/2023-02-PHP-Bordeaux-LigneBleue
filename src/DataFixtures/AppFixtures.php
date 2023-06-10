<?php

namespace App\DataFixtures;

use App\Entity\Sequence;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Entity\Tutorial;
use App\Repository\ThemeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager,): void
    {
        $themes = $this->createThemesFixtures($manager, 12);
        $tutorials = $this->createTutorialsFixtures($manager, $themes, 2);
        $this->createSequencesFixtures($manager, $tutorials, 3);
        $this->createTagsFixtures($manager, $tutorials, 2);

        $manager->flush();
    }

    private function createThemesFixtures(ObjectManager $manager, int $numberOfThemes): array
    {
        $themes = [];

        for ($i = 1; $i <= $numberOfThemes; $i++) {
            $themeData = [
                "title" => $this->faker->word(),
                "indexOrder" => $i,
                "iconPath" => "test/test.png"
            ];
            $theme = Theme::withData($themeData);
            $manager->persist($theme);
            $themes[] = $theme;
        }

        return $themes;
    }

    private function createTutorialsFixtures(ObjectManager $manager, array $themes, int $tutorialsPerThemes): array
    {
        $tutorials = [];

        foreach ($themes as $theme) {
            for ($i = 1; $i <= $tutorialsPerThemes; $i++) {
                $tutorialData = [
                    "title" => $this->faker->word(),
                    "objective" => $this->faker->sentence(),
                    "isPublished" => false,
                    "indexOrder" => $i,
                    "picturePath" => "test/test.png",
                    "iconPath" => "test/test.png"
                ];

                $tutorial = Tutorial::withData($tutorialData);
                $tutorial->setTheme($theme);

                $manager->persist($tutorial);
                $tutorials[] = $tutorial;
            }
        }

        return $tutorials;
    }

    private function createSequencesFixtures(ObjectManager $manager, array $tutorials, int $sequencesPerTutorial): array
    {
        $sequences = [];

        foreach ($tutorials as $tutorial) {
            for ($i = 1; $i <= $sequencesPerTutorial; $i++) {
                $sequenceData = [
                    "title" => $this->faker->word(),
                    "content" => $this->faker->paragraph(),
                    "exercice" => rand(1, 2) == 1 ? true : false,
                    "indexOrder" => $i,
                    "picturePath" => "test/test.png",
                    "videoPath" => "test/test.png"
                ];

                $sequence = Sequence::withData($sequenceData);
                $sequence->setTutorial($tutorial);

                $manager->persist($sequence);
                $sequences[] = $sequence;
            }
        }

        return $sequences;
    }

    private function createTagsFixtures(
        ObjectManager $manager,
        array $tutorials,
        int $tagsPerTutorial,
    ): array {
        $levelTags = ["débutant", "intermédiaire", "avancé"];
        $tags = [];

        foreach ($levelTags as $levelTag) {
            $tag = Tag::withTitle($levelTag);
            $manager->persist($tag);
            $tags[] = $tag;
        }

        foreach ($tutorials as $tutorial) {
            $tutorial->addTag($tags[array_rand($tags)]);
        }

        return $tags;
    }
}
