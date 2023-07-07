<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Repository\ThemeRepository;
use App\Repository\UserRepository;
use App\Repository\UserTutorialRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartService
{
    private ChartBuilderInterface $chartBuilder;
    private UserRepository $userRepository;
    private CategoryRepository $categoryRepository;
    private ThemeRepository $themeRepository;
    private UserTutorialRepository $userTutorialRepository;

    /**
     * @param ChartBuilderInterface $chartBuilder
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     * @param ThemeRepository $themeRepository
     * @param UserTutorialRepository $userTutorialRepository
     */
    public function __construct(
        ChartBuilderInterface $chartBuilder,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository,
        ThemeRepository $themeRepository,
        UserTutorialRepository $userTutorialRepository
    ) {
        $this->chartBuilder = $chartBuilder;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->themeRepository = $themeRepository;
        $this->userTutorialRepository = $userTutorialRepository;
    }
    public function createChartGender(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $sumHomme = count($this->userRepository->findBy(['gender' => 'homme',]));
        $sumFemme = count($this->userRepository->findBy(['gender' => 'femme',]));
        $sumNB = count($this->userRepository->findBy(['gender' => 'non-binaire',]));

        $chart->setData([
            'labels' => ['Homme', 'Femme', 'Non binaire'],
            'datasets' => [
                [
                    'backgroundColor' => ['#43A3DB', '#79C2BE', '#FFCA08'],
                    'data' => [$sumHomme, $sumFemme, $sumNB],
                ],
            ],
        ]);
        return $chart;
    }
    public function createChartAge(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $firstAgeSection = count($this->userRepository->findByAge(0, 25));
        $secondAgeSection = count($this->userRepository->findByAge(25, 45));
        $thirdAgeSection = count($this->userRepository->findByAge(45, 60));
        $fourthAgeSection = count($this->userRepository->findByAge(60, 200));

        $chart->setData([
            'labels' => ['0-25 ans', '25-45 ans', '45-60 ans', '60 ans et plus'],
            'datasets' => [
                [
                    'indexAxis' => 'y',
                    'backgroundColor' => ['#FF9C54', '#FF8051', '#CF4146', '#720019'],
                    'data' => [$firstAgeSection, $secondAgeSection, $thirdAgeSection, $fourthAgeSection],
                ],
            ],
        ]);
        return $chart;
    }
    public function createChartCategory(string $categoryName, string $type, string $color): Chart
    {
        $colors = [];

        switch ($color) {
            case 'blue':
                $colors = ['#04BBFF', '#0594D0', '#007198', '#003C57', '#051C24'];
                break;
            case 'green':
                $colors = ['#DCDFDA', '#C8D6A2', '#B7CE66', '#8FB43A', '#4B5943'];
                break;
            case 'red':
                $colors = ['#EA925E', '#C8574D', '#B13026', '#84181C', '#560905'];
                break;
            default:
                $colors = ['#2362B0', '#43A3DB', '#79C2BE', '#FFCA08', '#EC781D'];
        }

        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $category = $this->categoryRepository->findOneBy(['categoryTitle' => $categoryName,]);
        $categoryThemes = $this->themeRepository->findBy(['category' => $category]);
        $categoryThemesTitles = [];
        foreach ($categoryThemes as $categoryTheme) {
            $categoryThemesTitles[] = $categoryTheme->getTitle();
        }

        $tutorialLiked = $this->userTutorialRepository->findBy([$type => true]);

        $dataTutorialLiked = [];
        foreach ($tutorialLiked as $tutorial) {
            if (!isset($dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()])) {
                $dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()] = 1;
            } else {
                $dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()] += 1;
            }
        }

        $dataGlobal = [];
        foreach ($categoryThemesTitles as $categoryThemesTitle) {
            if (array_key_exists($categoryThemesTitle, $dataTutorialLiked)) {
                $dataGlobal[] = $dataTutorialLiked[$categoryThemesTitle];
            } else {
                $dataGlobal[] = 0;
            }
        }

        $chart->setData([
            'labels' => $categoryThemesTitles,
            'datasets' => [
                [
                    'label' => $categoryName,
                    'data' => $dataGlobal,
                    'backgroundColor' => $colors,
                ],
            ],
        ]);

        $chart->setOptions([
            'maintainAspectRatio' => false,
        ]);
        return $chart;
    }
}
