<?php

namespace App\Entity;

use App\Repository\TutorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutorialRepository::class)]
class Tutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objective = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(nullable: true)]
    private ?int $indexOrder = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picturePath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $iconPath = null;

    #[ORM\ManyToOne(inversedBy: 'tutorials')]
    private ?Theme $theme = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'tutorials')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'tutorial', targetEntity: Sequence::class)]
    private Collection $sequences;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->sequences = new ArrayCollection();
    }

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

    public function getObjective(): ?string
    {
        return $this->objective;
    }

    public function setObjective(?string $objective): self
    {
        $this->objective = $objective;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getIndexOrder(): ?int
    {
        return $this->indexOrder;
    }

    public function setIndexOrder(?int $indexOrder): self
    {
        $this->indexOrder = $indexOrder;

        return $this;
    }

    public function getPicturePath(): ?string
    {
        return $this->picturePath;
    }

    public function setPicturePath(?string $picturePath): self
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    public function getIconPath(): ?string
    {
        return $this->iconPath;
    }

    public function setIconPath(?string $iconPath): self
    {
        $this->iconPath = $iconPath;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public static function withData(array $data): self
    {
        $tutorial = new self();

        $tutorial->setTitle($data["title"]);
        $tutorial->setObjective(isset($data["objective"]) ? $data["objective"] : null);
        $tutorial->setIsPublished(isset($data["isPublished"]) ? $data["isPublished"] : false);
        $tutorial->setIndexOrder(isset($data["indexOrder"]) ? $data["indexOrder"] : null);
        $tutorial->setPicturePath(isset($data["picturePath"]) ? $data["picturePath"] : null);
        $tutorial->setIconPath(isset($data["iconPath"]) ? $data["iconPath"] : null);

        return $tutorial;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addTutorial($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeTutorial($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Sequence>
     */
    public function getSequences(): Collection
    {
        return $this->sequences;
    }

    public function addSequence(Sequence $sequence): self
    {
        if (!$this->sequences->contains($sequence)) {
            $this->sequences->add($sequence);
            $sequence->setTutorial($this);
        }

        return $this;
    }

    public function removeSequence(Sequence $sequence): self
    {
        if ($this->sequences->removeElement($sequence)) {
            // set the owning side to null (unless already changed)
            if ($sequence->getTutorial() === $this) {
                $sequence->setTutorial(null);
            }
        }

        return $this;
    }
}
