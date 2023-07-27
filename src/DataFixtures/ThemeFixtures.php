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
        $theme = FixturesContent::getThemesContent();
        $theme = array_map([$this, 'feedThemeObject'], $theme);
        array_walk($theme, [$manager, 'persist']);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function feedThemeObject(array $themeData): Theme
    {
        $theme = new Theme();

        $theme->setTitle($themeData["title"]);
        $theme->setIndexOrder($themeData["indexOrder"]);
        $theme->setSlug($this->slugger->slug($theme->getTitle()));
        $theme->setIconPath($themeData["iconPath"]);
        $theme->setCategory($this->getReference($themeData["categoryRef"]));
        $this->addReference("theme_" . $themeData["themeRef"] . "_" . $theme->getSlug(), $theme);

        return $theme;
    }
}
