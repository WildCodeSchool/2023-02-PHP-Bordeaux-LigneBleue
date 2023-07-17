<?php

namespace App\Controller;

use App\Entity\UserTutorial;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quiz;
use App\Service\QuizService;
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
    #[Route('/{quizTitle}/fin', name: 'app_quiz_end', methods: ['GET', 'POST'])]
    public function endQuiz(
        Request $request,
        string $quizTitle,
    ): Response {
        $encodedQuizTitle = urldecode($quizTitle);
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);
        $quizResults = $request->getSession()->get('quiz_results', []);
        $questions = $quiz->getQuestions();
        $questionCount = count($questions);
        $countCorrectAnswers = 0;

        foreach ($quizResults[$quizTitle] as $result) {
            if ($result) {
                $countCorrectAnswers++;
            }
        }
        $user = $this->getUser();
        $tutorial = $quiz->getTutorial();
        $userTutorial = $this->entityManager->getRepository(UserTutorial::class)->findOneBy([
            'user' => $user,
            'tutorial' => $tutorial
        ]);
        if ($userTutorial && $questionCount === $countCorrectAnswers) {
            $userTutorial->setIsValidated(true);
            $this->entityManager->persist($userTutorial);
            $this->entityManager->flush();
        }

        return $this->render('quiz/QuizEnded.html.twig', [
            'quiz' => $quiz,
            'quizResults' => $quizResults,
            'questionCount' => $questionCount,
            'countCorrectAnswers' => $countCorrectAnswers,
        ]);
    }

    #[Route('/{quizTitle}', name: 'app_quiz_start', methods: ['GET'])]
    public function start(Request $request, string $quizTitle): Response
    {
        if (!$this->getUser()) {
            $this->addFlash("Error", "Connectez-vous ou inscrivez-vous pour pouvoir accéder au quiz");
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
        QuizService $quizService,
        CsrfTokenManagerInterface $csrfTokenManager,
    ): Response {
        $encodedQuizTitle = urldecode($quizTitle);
        $quiz = $this->entityManager->getRepository(Quiz::class)->findOneBy(['title' => $encodedQuizTitle]);

        if (!$quiz) {
            throw $this->createNotFoundException('Quiz not found');
        }

        $questions = $quiz->getQuestions();
        $questionCount = count($questions);
        $quizResults = $request->getSession()->get('quiz_results', []);

        $quizService->saveQuizResult($request, $quizTitle, $questionIndex, $quizResults);
        if ($questionIndex === $questionCount + 1) {
            return $this->redirectToRoute('app_quiz_end', ['quizTitle' => $quizTitle]);
        }

        $question = $questions[$questionIndex - 1];
        $csrfToken = $csrfTokenManager->getToken('csrf-token')->getValue();

        return $this->render('quiz/question.html.twig', [
            'quiz' => $quiz,
            'question' => $question,
            'questionIndex' => $questionIndex,
            'questionCount' => $questionCount,
            'quizTitle' => $encodedQuizTitle,
            'csrf_token' => $csrfToken
        ]);
    }
}
