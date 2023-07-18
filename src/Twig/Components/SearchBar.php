<?php

namespace App\Twig\Components;

use App\Entity\Post;
use App\Form\PostType;
use App\Form\SearchBarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Repository\TutorialRepository;

#[AsLiveComponent()]
final class SearchBar extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(writable: true)]
    public string $query = "";

    public function __construct(
        private TutorialRepository $tutorialRepository
    ) {
    }

    public function getTutorials(): ?array
    {
        return empty($this->query) ? null : $this->tutorialRepository->searchTutorials($this->query, null, 5, null);
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(SearchBarType::class);
    }
}
