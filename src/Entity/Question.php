<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $prompt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $proposition1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $proposition2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $proposition3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $proposition4 = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quiz $quiz = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getProposition1(): ?string
    {
        return $this->proposition1;
    }

    public function setProposition1(string $proposition1): static
    {
        $this->proposition1 = $proposition1;

        return $this;
    }

    public function getProposition2(): ?string
    {
        return $this->proposition2;
    }

    public function setProposition2(string $proposition2): static
    {
        $this->proposition2 = $proposition2;

        return $this;
    }

    public function getProposition3(): ?string
    {
        return $this->proposition3;
    }

    public function setProposition3(?string $proposition3): static
    {
        $this->proposition3 = $proposition3;

        return $this;
    }

    public function getProposition4(): ?string
    {
        return $this->proposition4;
    }

    public function setProposition4(?string $proposition4): static
    {
        $this->proposition4 = $proposition4;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function isIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(?bool $isCorrect): static
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }
}
