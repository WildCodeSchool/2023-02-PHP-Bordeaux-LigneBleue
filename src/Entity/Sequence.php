<?php

namespace App\Entity;

use App\Repository\SequenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SequenceRepository::class)]
class Sequence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $exercice = null;

    #[ORM\Column(nullable: true)]
    private ?int $indexOrder = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picturePath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoPath = null;

    #[ORM\ManyToOne(inversedBy: 'sequences')]
    private ?Tutorial $tutorial = null;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isExercice(): ?bool
    {
        return $this->exercice;
    }

    public function setExercice(bool $exercice): self
    {
        $this->exercice = $exercice;

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

    public function getVideoPath(): ?string
    {
        return $this->videoPath;
    }

    public function setVideoPath(?string $videoPath): self
    {
        $this->videoPath = $videoPath;

        return $this;
    }

    public function getTutorial(): ?Tutorial
    {
        return $this->tutorial;
    }

    public function setTutorial(?Tutorial $tutorial): self
    {
        $this->tutorial = $tutorial;

        return $this;
    }

    public static function withData(array $data): self
    {
        $sequence = new self();

        $sequence->setTitle($data["title"]);
        $sequence->setContent(isset($data["content"]) ? $data["content"] : null);
        $sequence->setExercice(isset($data["exercice"]) ? $data["exercice"] : false);
        $sequence->setIndexOrder(isset($data["indexOrder"]) ? $data["indexOrder"] : null);
        $sequence->setPicturePath(isset($data["picturePath"]) ? $data["picturePath"] : null);
        $sequence->setVideoPath(isset($data["videoPath"]) ? $data["videoPath"] : null);

        return $sequence;
    }
}
