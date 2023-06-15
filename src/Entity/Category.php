<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categoryTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $categoryIndexOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $categoryIconPath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryTitle(): ?string
    {
        return $this->categoryTitle;
    }

    public function setCategoryTitle(string $title): self
    {
        $this->categoryTitle = $title;

        return $this;
    }

    public function getCategoryIndexOrder(): ?int
    {
        return $this->categoryIndexOrder;
    }

    public function setCategoryIndexOrder(?int $indexOrder): self
    {
        $this->categoryIndexOrder = $indexOrder;

        return $this;
    }

    public function getCategoryIconPath(): ?string
    {
        return $this->categoryIconPath;
    }

    public function setCategoryIconPath(string $iconPath): self
    {
        $this->categoryIconPath = $iconPath;

        return $this;
    }
}
