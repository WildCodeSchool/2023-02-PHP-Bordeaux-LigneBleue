<?php

namespace App\Entity;

use App\Repository\UserTutorialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTutorialRepository::class)]
class UserTutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tutorial $tutorial = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column]
    private ?bool $favorite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTutorial(): ?Tutorial
    {
        return $this->tutorial;
    }

    public function setTutorial(Tutorial $tutorial): self
    {
        $this->tutorial = $tutorial;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }

    public static function withData(array $data): self
    {
        $userTutorial = new self();

        $userTutorial->setUser($data["user"]);
        $userTutorial->setTutorial($data["tutorial"]);
        $userTutorial->setStatus($data["status"]);
        $userTutorial->setFavorite($data["favorite"]);

        return $userTutorial;
    }
}
