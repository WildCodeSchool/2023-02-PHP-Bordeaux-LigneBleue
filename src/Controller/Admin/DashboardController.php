<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Sequence;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Entity\Tutorial;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\ThemeRepository;
use App\Repository\TutorialRepository;
use App\Repository\UserRepository;
use App\Repository\UserTutorialRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
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
    public function __construct(ChartBuilderInterface $chartBuilder, UserRepository $userRepository, CategoryRepository $categoryRepository, ThemeRepository $themeRepository, UserTutorialRepository $userTutorialRepository)
    {
        $this->chartBuilder = $chartBuilder;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->themeRepository = $themeRepository;
        $this->userTutorialRepository = $userTutorialRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $charts = $this->createCharts();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

//        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
        return $this->render('admin/index.html.twig', [
            'chart1' => $charts['chart1'],
            'chart2' => $charts['chart2'],
            'chart3' => $charts['chart3'],
            ]);


        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Ligne Bleue')
            ->disableDarkMode();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
/*        yield MenuItem::linkToUrl(
            'Statistiques',
            "fa-sharp fa-solid fa-chart-simple",
            $this->generateUrl('app_chart')
        );*/
        yield MenuItem::linkToCrud('Catégories', 'fas fa-1', Category::class);
        yield MenuItem::linkToCrud('Thèmes', 'fas fa-2', Theme::class);
        yield MenuItem::linkToCrud('Formations', 'fas fa-3', Tutorial::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tag', Tag::class);
        yield MenuItem::linkToCrud('Sequences', 'fas fa-sharp fa-light fa-book', Sequence::class);
        yield MenuItem::linkToCrud('Quiz', 'fas fa-medal', Quiz::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-question', Question::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-sharp fa-light fa-arrow-left', $this->generateUrl('app_home'));
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setMenuItems([
                // MenuItem::linkToUrl('Voir mon profil', 'fas fa-user', $this->generateUrl('app_user')),
                MenuItem::linkToLogout('Me déconnecter', 'fas fa-arrow-right-from-bracket')
            ]);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }

    #[Route('/chart', name: 'app_chart')]
    public function createCharts(): array
    {
        $chart1 = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $sumHomme = count($this->userRepository->findBy(['gender' => 'homme',]));
        $sumFemme = count($this->userRepository->findBy(['gender' => 'femme',]));
        $sumNB = count($this->userRepository->findBy(['gender' => 'non-binaire',]));

        $chart1->setData([
            'labels' => ['Homme', 'Femme', 'Non binaire'],
            'datasets' => [
                [
                    'backgroundColor' => ['#0C5395', '#6e0c37', '#457a4d'],
                    'data' => [$sumHomme, $sumFemme, $sumNB],
                ],
            ],
        ]);

        $chart2 = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $firstAgeSection = count($this->userRepository->findByAge(0, 25));
        $secondAgeSection = count($this->userRepository->findByAge(25, 45));
        $thirdAgeSection = count($this->userRepository->findByAge(45, 60));
        $fourthAgeSection = count($this->userRepository->findByAge(60, 200));

        $chart2->setData([
            'labels' => ['0-25 ans', '25-45 ans', '45-60 ans', '60 ans et plus'],
            'datasets' => [
                [
                    'indexAxis' => 'y',
                    'backgroundColor' => ['#1a7cd9', '#135ea4', '#0b3d6c', '#072949'],
                    'hoverBackgroundColor' => ['#FFCB05'],
                    'data' => [$firstAgeSection, $secondAgeSection, $thirdAgeSection, $fourthAgeSection],
                ],
            ],
        ]);

        $chart3 = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $catSmartphone = $this->categoryRepository->findOneBy(['categoryTitle' => 'Smartphone',]);
        $smartphoneThemes = $this->themeRepository->findBy(['category' => $catSmartphone]);
        $smartphoneThemesTitles = [];
        foreach ($smartphoneThemes as $smartphoneTheme) {
            $smartphoneThemesTitles[] = $smartphoneTheme->getTitle();
        }

        $tutorialLiked = $this->userTutorialRepository->findBy(['isLiked' => true]);

        $dataTutorialLiked = [];
        foreach ($tutorialLiked as $tutorial) {
            if (!isset($dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()])) {
                $dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()] = 1;
            } else {
                $dataTutorialLiked[$tutorial->getTutorial()->getTheme()->getTitle()] += 1;
            }
        }

        $dataGlobal = [];
        foreach ($smartphoneThemesTitles as $smartphoneThemesTitle) {
            if (array_key_exists($smartphoneThemesTitle, $dataTutorialLiked)) {
                $dataGlobal[] = $dataTutorialLiked[$smartphoneThemesTitle];
            } else {
                $dataGlobal[] = 0;
            }
        }

//        dd($dataGlobal);

        $chart3->setData([
            'labels' => [$smartphoneThemesTitles],
            'datasets' => [
                [
                    'data' => [$dataGlobal],
                ],
            ],
        ]);

        return ['chart1' => $chart1, 'chart2' => $chart2, 'chart3' => $chart3];
    }
}
