<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager,): void
    {
        $this->createThemesFixtures($manager, 12);

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
}
