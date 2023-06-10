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
        $faker = Factory::create();


        $numberOfThemes = 12;
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

        $manager->flush();
    }
}
