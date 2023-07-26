<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Tutorial;
use App\Service\FixturesContent;
use Symfony\Component\String\Slugger\SluggerInterface;

class QuizFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $quizzes = FixturesContent::getAllQuizzesContent();
        $quizzes = array_map([$this, "feedQuizObject"], $quizzes);
        array_walk($quizzes, [$manager, "persist"]);

        // dd(FixturesContent::getAllQuestionsContent());

        $questions = FixturesContent::getAllQuestionsContent();
        $questions = array_map([$this, "feedQuestionObject"], $questions);
        array_walk($questions, [$manager, "persist"]);


        // foreach (FixturesContent::getAllQuizzesContent() as $quizData) {
        //     echo $quizData["quizRef"] . "\n";
        // }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TutorialFixtures::class];
    }

    public function feedQuizObject(array $quizData): Quiz
    {
        $quiz = new Quiz();

        $tutorial = $this->getReference($quizData["tutorialRef"]);

        $quiz->setTitle($tutorial->getTitle());
        $quiz->setTutorial($tutorial);
        $quiz->setSlug($this->slugger->slug($quiz->getTitle()));
        $this->addReference($quizData["quizRef"], $quiz);

        return $quiz;
    }

    public function feedQuestionObject(array $questionData): Question
    {
        $question = new Question();

        $question->setPrompt($questionData['prompt']);
        $question->setProposition1($questionData['proposition1']);
        $question->setProposition2($questionData['proposition2']);
        $question->setProposition3($questionData['proposition3']);
        $question->setProposition4($questionData['proposition4']);
        $question->setAnswer($questionData['answer']);
        $question->setQuiz($this->getReference($questionData["quizRef"]));

        return $question;
    }
}
