<?php

namespace App\Controller;

use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quiz;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/quiz')]
class QuizController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findAll();

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    #[Route('/{quizTitle}', name: 'app_quiz_start', methods: ['GET'])]
    public function start(Request $request, string $quizTitle): Response
    {
        if (!$this->getUser()) {
            $this->addFlash("Error", "Connectez-vous ou inscrivez-vous pour pouvoir acceder au quiz");
            return $this->redirectToRoute("app_login");
        }

        $encodedQuizTitle = urldecode($quizTitle);
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        return $this->render('quiz/start.html.twig', [
            'quiz' => $quiz,
            'questionIndex' => 0,
        ]);
    }

    #[Route('/{quizTitle}/{questionIndex}', name: 'app_question_show', methods: ['GET', 'POST'])]
    public function showByIndex(
        Request $request,
        string $quizTitle,
        ?int $questionIndex,
        CsrfTokenManagerInterface $csrfTokenManager
    ): Response {
        $encodedQuizTitle = urldecode($quizTitle);
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        $questions = $quiz->getQuestions();
        $questionCount = count($questions);
        $quizResults = $request->getSession()->get('quiz_results', []);

        if ($request->isMethod('POST')) {
            $requestData = json_decode($request->getContent(), true);
            $countRightAnswers = $requestData['countRightAnswers'];
            $quizResults[$quizTitle][$questionIndex] = $countRightAnswers;
            $request->getSession()->set('quiz_results', $quizResults);
        }

        if ($questionIndex === $questionCount + 1) {
            $countCorrectAnswers = 0;
            foreach ($quizResults[$quizTitle] as $result) {
                if ($result) {
                    $countCorrectAnswers++;
                }
            }

            return $this->render('quiz/QuizEnded.html.twig', [
                'quiz' => $quiz,
                'quizResults' => $quizResults,
                'questionCount' => $questionCount,
                'countCorrectAnswers' => $countCorrectAnswers,
            ]);
        }

        if ($questionIndex < 0 || $questionIndex > $questionCount) {
            throw $this->createNotFoundException('Question not found');
        }

        $question = $questions[$questionIndex - 1];
        $csrfToken = $csrfTokenManager->getToken('csrf-token')->getValue();

        return $this->render('quiz/question.html.twig', [
            'quiz' => $quiz,
            'question' => $question,
            'questionIndex' => $questionIndex,
            'questionCount' => $questionCount,
            'quizTitle' => $encodedQuizTitle,
            'csrf_token' => $csrfToken,
        ]);
    }
}
