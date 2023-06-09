<?php

namespace App\Entity;

use App\Repository\TutorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $objective = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(nullable: true)]
    private ?int $indexOrder = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picturePath = null;

    #[ORM\ManyToOne(inversedBy: 'tutorials')]
    private ?Theme $theme = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'tutorials')]
    private Collection $tags;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'tutorial', targetEntity: Sequence::class)]
    private Collection $sequences;

    #[ORM\OneToOne(mappedBy: 'tutorial', cascade: ['persist', 'remove'])]
    private ?Quiz $quiz = null;

    #[ORM\OneToMany(mappedBy: 'tutorial', targetEntity: UserTutorial::class)]
    private Collection $userTutorials;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->sequences = new ArrayCollection();
        $this->userTutorials = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
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

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $tutorial): self
    {
        $this->theme = $tutorial;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addTutorial($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeTutorial($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Sequence>
     */
    public function getSequences(): Collection
    {
        return $this->sequences;
    }

    public function addSequence(Sequence $sequence): static
    {
        if (!$this->sequences->contains($sequence)) {
            $this->sequences->add($sequence);
            $sequence->setTutorial($this);
        }

        return $this;
    }

    public function removeSequence(Sequence $sequence): static
    {
        if ($this->sequences->removeElement($sequence)) {
            // set the owning side to null (unless already changed)
            if ($sequence->getTutorial() === $this) {
                $sequence->setTutorial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserTutorial>
     */
    public function getUserTutorials(): Collection
    {
        return $this->userTutorials;
    }

    public function addUserTutorial(UserTutorial $userTutorial): static
    {
        if (!$this->userTutorials->contains($userTutorial)) {
            $this->userTutorials->add($userTutorial);
            $userTutorial->setTutorial($this);
        }

        return $this;
    }

    public function removeUserTutorial(UserTutorial $userTutorial): static
    {
        if ($this->userTutorials->removeElement($userTutorial)) {
            // set the owning side to null (unless already changed)
            if ($userTutorial->getTutorial() === $this) {
                $userTutorial->setTutorial(null);
            }
        }

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }
    public function setQuiz(Quiz $quiz): static
    {
        // set the owning side of the relation if necessary
        if ($quiz->getTutorial() !== $this) {
            $quiz->setTutorial($this);
        }
        $this->quiz = $quiz;
        return $this;
    }
}
