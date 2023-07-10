<?php

namespace App\Service;

use App\Entity\UserTutorial;
use Symfony\Component\HttpFoundation\Request;

class QuizService
{
    public function saveQuizResult(Request $request, string $quizTitle, ?int $questionIndex, array $quizResults): void
    {
        if ($request->isMethod('POST')) {
            $requestData = json_decode($request->getContent(), true);
            $countRightAnswers = $requestData['countRightAnswers'];
            $quizResults[$quizTitle][$questionIndex] = $countRightAnswers;
            $request->getSession()->set('quiz_results', $quizResults);
        }
    }
}
