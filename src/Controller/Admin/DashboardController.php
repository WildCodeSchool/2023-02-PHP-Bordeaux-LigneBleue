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
use App\Service\ChartService;
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
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    private ChartService $chartService;

    /**
     * @param ChartService $chartService
     */
    public function __construct(ChartService $chartService)
    {
        $this->chartService = $chartService;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $charts = $this->createCharts();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
//        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

//        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
        return $this->render('admin/index.html.twig', [
            'chartGender' => $charts['chartGender'],
            'chartAge' => $charts['chartAge'],
            'chartSmartphoneLiked' => $charts['chartSmartphoneLiked'],
            'chartOrdinateurLiked' => $charts['chartOrdinateurLiked'],
            'chartAutresLiked' => $charts['chartAutresLiked'],
            'chartSmartphoneStarted' => $charts['chartSmartphoneStarted'],
            'chartOrdinateurStarted' => $charts['chartOrdinateurStarted'],
            'chartAutresStarted' => $charts['chartAutresStarted'],
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
        yield MenuItem::linkToUrl(
            'Retour au site',
            'fas fa-sharp fa-light fa-arrow-left',
            $this->generateUrl('app_home')
        );
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

    public function createCharts(): array
    {
        $chartGender = $this->chartService->createChartGender();
        $chartAge = $this->chartService->createChartAge();
//        $chartSmartphoneLiked = $this->chartService->createChartCategoryTwoTypes('Smartphone');
        $chartSmartphoneLiked = $this->chartService->createChartCategory('Smartphone', 'isLiked', 'green');
        $chartOrdinateurLiked = $this->chartService->createChartCategory('Ordinateur', 'isLiked', 'red');
        $chartAutresLiked = $this->chartService->createChartCategory('Autres', 'isLiked', 'blue');
        $chartSmartphoneStarted = $this->chartService->createChartCategory('Smartphone', 'isStarted', 'green');
        $chartOrdinateurStarted = $this->chartService->createChartCategory('Ordinateur', 'isStarted', 'red');
        $chartAutresStarted = $this->chartService->createChartCategory('Autres', 'isStarted', 'blue');

        return [
            'chartGender' => $chartGender,
            'chartAge' => $chartAge,
            'chartSmartphoneLiked' => $chartSmartphoneLiked,
            'chartOrdinateurLiked' => $chartOrdinateurLiked,
            'chartAutresLiked' => $chartAutresLiked,
            'chartSmartphoneStarted' => $chartSmartphoneStarted,
            'chartOrdinateurStarted' => $chartOrdinateurStarted,
            'chartAutresStarted' => $chartAutresStarted,
        ];
    }
}
