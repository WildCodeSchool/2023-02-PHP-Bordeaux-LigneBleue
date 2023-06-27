<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Tutorial;

class QuizFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->loadQuizzes($manager);
    }

    private function loadQuizzes(ObjectManager $manager): void
    {

        $tutorials = $manager->getRepository(Tutorial::class)->findAll();

        foreach ($tutorials as $tutorial) {
            $quiz = new Quiz();
            $quiz->setTitle('Quiz ' . $tutorial->getId());
            $quiz->setQuestionsAmount(3);
            $quiz->setTutorial($tutorial);
            $manager->persist($quiz);

            $this->createQuestions($manager, $quiz);
        }

        $manager->flush();
    }

    private function createQuestions(ObjectManager $manager, Quiz $quiz): void
    {
        $questionsData = [
            [
                'prompt' => '¿Cuál es la capital de Francia?',
                'proposition1' => 'Roma',
                'proposition2' => 'París',
                'proposition3' => 'Londres',
                'proposition4' => 'Berlín',
                'answer' => 'París',
            ],
            [
                'prompt' => '¿Combien de Champions a gaigné le Barça ?',
                'proposition1' => '3',
                'proposition2' => '11',
                'proposition3' => '1',
                'proposition4' => '5',
                'answer' => '5',
            ],
        ];

        foreach ($questionsData as $questionData) {
            $question = new Question();
            $question->setPrompt($questionData['prompt']);
            $question->setProposition1($questionData['proposition1']);
            $question->setProposition2($questionData['proposition2']);
            $question->setProposition3($questionData['proposition3']);
            $question->setProposition4($questionData['proposition4']);
            $question->setAnswer($questionData['answer']);
            $question->setQuiz($quiz);
            $manager->persist($question);
        }
    }
    public function getDependencies()
    {
        return [TutorialFixtures::class];
    }
}
