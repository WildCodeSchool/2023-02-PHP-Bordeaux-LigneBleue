<?php

namespace App\DataFixtures;

use App\Entity\Theme;
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
        $manager->persist($this->feedThemeObject(
            "Communication",
            1,
            "smartphone/communications/llb-icon-message.png",
            "category_Smartphone",
            'Smartphone'
        ));

        $manager->persist($this->feedThemeObject(
            "Hardware",
            2,
            "smartphone/hardware/llb-icon-hardware.png",
            "category_Smartphone",
            'Smartphone'
        ));

        $manager->persist($this->feedThemeObject(
            "Software",
            3,
            "smartphone/software/llb-icon-software.png",
            "category_Smartphone",
            'Smartphone'
        ));


        $manager->persist($this->feedThemeObject(
            "Hardware",
            1,
            "desktop/hardware/llb-icon-desktop.png",
            "category_Ordinateur",
            'Computer'
        ));

        $manager->persist($this->feedThemeObject(
            "Internet",
            2,
            "desktop/browser/llb-icon-browser.png",
            "category_Ordinateur",
            'Computer'
        ));

        $manager->persist($this->feedThemeObject(
            "Communications",
            3,
            "desktop/communications/llb-icon-paperPlane.png",
            "category_Ordinateur",
            'Computer'
        ));


        $manager->persist($this->feedThemeObject(
            "Accessoires Connectés",
            1,
            "others/accessories/llb-icon-watch.png",
            "category_Autres",
            'Others'
        ));

        $manager->persist($this->feedThemeObject(
            "Box Internet",
            2,
            "others/boxInternet/llb-icon-server.png",
            "category_Autres",
            'Others'
        ));

        $manager->persist($this->feedThemeObject(
            "TVs Connectées",
            3,
            "others/smartTvs/llb-icon-smartTV.png",
            "category_Autres",
            'Others'
        ));


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
        $this->addReference("theme_" . $themeRef . "_" . $theme->getTitle(), $theme);

        return $theme;
    }
}
