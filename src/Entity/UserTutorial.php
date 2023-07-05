<?php

namespace App\Entity;

use App\Repository\UserTutorialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTutorialRepository::class)]
class UserTutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userTutorials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userTutorials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tutorial $tutorial = null;

    #[ORM\Column]
    private ?bool $isValidated = false;

    #[ORM\Column]
    private ?bool $isLiked = false;

    #[ORM\Column]
    private ?bool $isStarted = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @param bool|null $isValidated
     * @param bool|null $isLiked
     * @param bool|null $isStarted
     */
    public function __construct(?bool $isStarted, ?bool $isLiked, ?bool $isValidated)
    {
        $this->isStarted = $isStarted;
        $this->isValidated = $isValidated;
        $this->isLiked = $isLiked;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTutorial(): ?Tutorial
    {
        return $this->tutorial;
    }

    public function setTutorial(?Tutorial $tutorial): static
    {
        $this->tutorial = $tutorial;

        return $this;
    }

    public function isIsValidated(): ?bool
    {
        return $this->isValidated;
    }

    public function setIsValidated(bool $isValidated): static
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function isIsLiked(): ?bool
    {
        return $this->isLiked;
    }

    public function setIsLiked(bool $isLiked): static
    {
        $this->isLiked = $isLiked;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return bool|null
     */
    public function getIsStarted(): ?bool
    {
        return $this->isStarted;
    }

    /**
     * @param bool|null $isStarted
     */
    public function setIsStarted(?bool $isStarted): void
    {
        $this->isStarted = $isStarted;
    }
}
