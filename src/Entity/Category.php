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
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $indexOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $iconPath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIndexOrder(): ?string
    {
        return $this->indexOrder;
    }

    public function setIndexOrder(?string $indexOrder): self
    {
        $this->indexOrder = $indexOrder;

        return $this;
    }

    public function getIconPath(): ?string
    {
        return $this->iconPath;
    }

    public function setIconPath(string $iconPath): self
    {
        $this->iconPath = $iconPath;

        return $this;
    }
}
