<?php

namespace App\Controller;

use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quiz;

#[Route('/quiz')]
class QuizController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        // Obtener todos los quizzes desde el repositorio
        $quizzes = $quizRepository->findAll();

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    #[Route('/{quizTitle}', name: 'app_quiz_start', methods: ['GET'])]
    public function start(string $quizTitle): Response
    {
        $encodedQuizTitle = urldecode($quizTitle);

        // Obtener el quiz correspondiente al título proporcionado
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        return $this->render('quiz/start.html.twig', [
            'quiz' => $quiz,
            'questionIndex' => 0

        ]);
    }

    #[Route('/{quizTitle}/question/{questionIndex}', name: 'app_question_show', methods: ['GET'])]
    public function showByIndex(string $quizTitle, ?int $questionIndex): Response
    {
        $encodedQuizTitle = urldecode($quizTitle);
        // Obtener el quiz correspondiente al título proporcionado
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        // Obtener las preguntas del quiz
        $questions = $quiz->getQuestions();
        $questionCount = count($questions);

        if ($questionIndex > $questionCount ) {
            // Redirigir a la página Quizended.html.twig
            return $this->render('Quizended.html.twig');
        }
        // Verificar si el índice de pregunta está dentro del rango válido
        if ($questionIndex < 0 || $questionIndex >= $questionCount) {
            throw $this->createNotFoundException('Question not found');
        }


        $question = $questions[$questionIndex];

        return $this->render('quiz/question.html.twig', [
            'quiz' => $quiz,
            'question' => $question,
            'questionIndex' => $questionIndex + 1,
            'questionCount' => $questionCount,
            'quizTitle' => $encodedQuizTitle

        ]);
    }
}
