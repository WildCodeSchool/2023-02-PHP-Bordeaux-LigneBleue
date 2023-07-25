<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use App\Service\FixturesContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ThemeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (FixturesContent::getThemes() as $theme) {
            $manager->persist($this->feedThemeObject(
                $theme[0],
                $theme[1],
                $theme[2],
                $theme[3],
                $theme[4]
            ));
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function feedThemeObject(
        string $title,
        int $indexOrder,
        string $iconPath,
        string $categoryRef,
        string $themeRef
    ): Theme {
        $theme = new Theme();

        $theme->setTitle($title);
        $theme->setIndexOrder($indexOrder);
        $theme->setSlug($this->slugger->slug($theme->getTitle()));
        $theme->setIconPath($iconPath);
        $theme->setCategory($this->getReference($categoryRef));
        $this->addReference("theme_" . $themeRef . "_" . $theme->getSlug(), $theme);
        echo "theme_" . $themeRef . "_" . $theme->getSlug() . "\n";

        return $theme;
    }
}
