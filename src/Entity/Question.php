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

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Quiz $quiz = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getProposition1(): ?string
    {
        return $this->proposition1;
    }

    public function setProposition1(string $proposition1): self
    {
        $this->proposition1 = $proposition1;

        return $this;
    }

    public function getProposition2(): ?string
    {
        return $this->proposition2;
    }

    public function setProposition2(string $proposition2): self
    {
        $this->proposition2 = $proposition2;

        return $this;
    }

    public function getProposition3(): ?string
    {
        return $this->proposition3;
    }

    public function setProposition3(?string $proposition3): self
    {
        $this->proposition3 = $proposition3;

        return $this;
    }

    public function getProposition4(): ?string
    {
        return $this->proposition4;
    }

    public function setProposition4(?string $proposition4): self
    {
        $this->proposition4 = $proposition4;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    public static function withData(array $data): self
    {
        $question = new self();

        $question->setPrompt($data["prompt"]);
        $question->setProposition1($data["proposition1"]);
        $question->setProposition2($data["proposition2"]);
        $question->setProposition3(isset($data["proposition3"]) ? $data["proposition3"] : null);
        $question->setProposition4(isset($data["proposition4"]) ? $data["proposition4"] : null);
        $question->setAnswer($data["answer"]);

        return $question;
    }
}
