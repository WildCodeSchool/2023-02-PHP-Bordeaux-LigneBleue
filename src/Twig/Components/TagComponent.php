<?php

namespace App\Twig\Components;

use App\Repository\TagRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class TagComponent
{
    public function __construct(
        private TagRepository $tagRepository
    ) {
    }

    public function getTags(): array
    {
        return $this->tagRepository->findAll();
    }
}
