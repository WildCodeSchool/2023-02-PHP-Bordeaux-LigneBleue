<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Theme::class)]
    private Collection $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->categoryTitle;
    }

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

    /**
     * @return Collection<int, Theme>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
            $theme->setCategory($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->themes->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getCategory() === $this) {
                $theme->setCategory(null);
            }
        }

        return $this;
    }
}
