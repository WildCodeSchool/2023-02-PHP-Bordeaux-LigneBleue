<?php

namespace App\Twig\Components;

use App\Repository\ThemeRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class ThemeComponent
{
    public function __construct(
        private ThemeRepository $themeRepository
    ) {
    }

    public function getThemes(): array
    {
        return $this->themeRepository->findAll();
    }
}
