<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Repository\TutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, TutorialRepository $tutorialRepository): Response
    {
        $searchForm = $this->createFormBuilder()
            ->add("search", TextType::class, [
                'label' => false,
                'csrf_protection' => false,
                'attr' => [
                    'class' => 'form-control llb_navbar_search_form',
                    'placeholder' => 'Je cherche une formation',
                    'aria-label' => "Search",
                    'type' => "search"
                ],
            ])
            ->setMethod('GET')
            ->setAction("/search")
            ->getForm();

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchData = $searchForm->getData()["search"];
            $session = $request->getSession();
            $session->set("searchData", $searchData);

            $tutorials = $tutorialRepository->searchTutorials($searchData);
            return $this->render('search/index.html.twig', [
                'searchData' => $searchData,
                'tutorials' => $tutorials
            ]);
        }

        return $this->render('search/_form.html.twig', [
            'searchForm' => $searchForm
        ]);
    }

    #[Route('/search/category/{category}', name: 'app_search_filter_category')]
    public function filterByCategory(
        Request $request,
        Category $category,
        TutorialRepository $tutorialRepository
    ): Response {
        $session = $request->getSession();
        $session->set("category", $category->getCategoryTitle());
        $searchData = $session->get("searchData");

        $tutorials = $tutorialRepository->filterByCategory($searchData, $category->getID());

        return $this->render('search/index.html.twig', [
            'searchData' => $searchData,
            'tutorials' => $tutorials
        ]);
    }

    #[Route('/search/theme/{theme}', name: 'app_search_filter_theme')]
    public function filterByTheme(
        Request $request,
        Theme $theme,
        TutorialRepository $tutorialRepository
    ): Response {
        $session = $request->getSession();
        $session->set("theme", $theme->getTitle());
        $searchData = $session->get("searchData");

        $tutorials = $tutorialRepository->filterByTheme($searchData, $theme->getID());

        return $this->render('search/index.html.twig', [
            'searchData' => $searchData,
            'tutorials' => $tutorials
        ]);
    }

    #[Route('/search/tag/{tag}', name: 'app_search_filter_tag')]
    public function filterByTag(
        Request $request,
        Tag $tag,
        TutorialRepository $tutorialRepository
    ): Response {
        $session = $request->getSession();
        $session->set("tag", $tag->getTitle());
        $searchData = $session->get("searchData");

        $tutorials = $tutorialRepository->filterByTag($searchData, $tag->getID());

        return $this->render('search/index.html.twig', [
            'searchData' => $searchData,
            'tutorials' => $tutorials
        ]);
    }
}
