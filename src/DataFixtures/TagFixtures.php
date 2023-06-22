<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tagsTitle = [
            "Débutant",
            "Intermédiaire",
            "Avancé"
        ];

        foreach ($tagsTitle as $title) {
            $tag = new Tag();
            $tag->setTitle($title);
            $manager->persist($tag);
            $this->addReference("tag_" . $tag->getTitle(), $tag);
        }

        $manager->flush();
    }
}
