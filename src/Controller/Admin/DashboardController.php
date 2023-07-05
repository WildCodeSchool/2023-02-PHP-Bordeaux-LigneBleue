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

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());

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
            ->setTitle('La Ligne Bleue');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
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

}
