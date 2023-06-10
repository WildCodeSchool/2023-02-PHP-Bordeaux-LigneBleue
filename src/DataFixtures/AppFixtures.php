<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use App\Entity\Tutorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager,): void
    {
        $themes = $this->createThemesFixtures($manager, 12);
        $this->createTutorialsFixtures($manager, $themes, 2);



        $manager->flush();
    }

    private function createThemesFixtures(ObjectManager $manager, int $numberOfThemes): array
    {
        $faker = Factory::create();
        $themes = [];

        for ($i = 1; $i <= $numberOfThemes; $i++) {
            $themeData = [
                "title" => $faker->word(),
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
        $faker = Factory::create();
        $tutorials = [];

        foreach ($themes as $theme) {
            for ($i = 1; $i <= $tutorialsPerThemes; $i++) {
                $tutorialData = [
                    "title" => $faker->word(),
                    "objective" => $faker->sentence(),
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
}
