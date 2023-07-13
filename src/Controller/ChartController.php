<?php

namespace App\Controller;

use App\Service\ChartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    public function __construct(private ChartService $chartService)
    {
    }

    #[Route('/chart', name: 'app_chart')]
    public function index(): Response
    {
        $charts = $this->createCharts();

        return $this->render('chart/index.html.twig', [
            'chartGender' => $charts['chartGender'],
            'chartAge' => $charts['chartAge'],
            'chartSmartphoneLiked' => $charts['chartSmartphoneLiked'],
            'chartOrdinateurLiked' => $charts['chartOrdinateurLiked'],
            'chartAutresLiked' => $charts['chartAutresLiked'],
            'chartSmartphoneStarted' => $charts['chartSmartphoneStarted'],
            'chartOrdinateurStarted' => $charts['chartOrdinateurStarted'],
            'chartAutresStarted' => $charts['chartAutresStarted'],
        ]);
    }

    public function createCharts(): array
    {
        $chartGender = $this->chartService->createChartGender();
        $chartAge = $this->chartService->createChartAge();
//        $chartSmartphoneLiked = $this->chartService->createChartCategoryTwoTypes('Smartphone');
        $chartSmartphoneLiked = $this->chartService->createChartCategory('Smartphone', 'isLiked', 'green');
        $chartOrdinateurLiked = $this->chartService->createChartCategory('Ordinateur', 'isLiked', 'red');
        $chartAutresLiked = $this->chartService->createChartCategory('Autres', 'isLiked', 'blue');
        $chartSmartphoneStart = $this->chartService->createChartCategory('Smartphone', 'isStarted', 'green');
        $chartOrdinateurStart = $this->chartService->createChartCategory('Ordinateur', 'isStarted', 'red');
        $chartAutresStarted = $this->chartService->createChartCategory('Autres', 'isStarted', 'blue');

        return [
            'chartGender' => $chartGender,
            'chartAge' => $chartAge,
            'chartSmartphoneLiked' => $chartSmartphoneLiked,
            'chartOrdinateurLiked' => $chartOrdinateurLiked,
            'chartAutresLiked' => $chartAutresLiked,
            'chartSmartphoneStarted' => $chartSmartphoneStart,
            'chartOrdinateurStarted' => $chartOrdinateurStart,
            'chartAutresStarted' => $chartAutresStarted,
        ];
    }
}
