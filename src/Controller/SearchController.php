<?php

namespace App\Controller;

use App\Form\FilterFormType;
use App\Form\SearchBarType;
use App\Repository\TutorialRepository;
use App\Repository\UserTutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route("/search", name: "app_search")]
    public function search(
        Request $request,
        TutorialRepository $tutorialRepository,
        UserTutorialRepository $utRepository,
    ): Response {

        $session = $request->getSession();
        $userInput = $session->get("userInput");
        $filters = $session->get("filters");
        $user = $this->getUser();

        if (isset($user)) {
            $tutorials = $tutorialRepository->searchTutorials($userInput, $filters, null, $user->getId());
        } else {
            $tutorials = $tutorialRepository->searchTutorials($userInput, $filters, null, null);
        }

        $userTutorials = [];
        foreach ($tutorials as $tutorial) {
            $userTutorial = $utRepository->findOneBy(['tutorial' => $tutorial]);
            $userTutorials[$tutorial->getId()] = $userTutorial;
        }

        $filterForm = $this->createForm(FilterFormType::class);

        return $this->render('search/index.html.twig', [
            'userInput' => $userInput,
            'tutorials' => $tutorials,
            "filterForm" => $filterForm,
            'userTutorials' => $userTutorials
        ]);
    }

    #[Route('/search/form', name: 'app_search_form')]
    public function renderSearchForm(Request $request): Response
    {
        $searchForm = $this->createForm(SearchBarType::class);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $session = $request->getSession();
            $session->remove("userInput");
            $session->remove("filters");

            $userInput = $searchForm->getData()["search"];
            $session->set("userInput", $userInput);

            return $this->redirectToRoute("app_search");
        }

        return $this->render("components/SearchBar.html.twig");
    }

    #[Route("/search/ResetFilters", name: "app_search_reset_filters")]
    public function resetFilter(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove("filters");

        return $this->redirectToRoute("app_search");
    }

    #[Route("/search/removeFilter/{filterRaw}", name: "app_search_remove_filters")]
    public function removeFilter(Request $request, string $filterRaw): Response
    {
        $session = $request->getSession();
        $filters = $session->get("filters");
        unset($filters[$filterRaw]);
        $session->set("filters", $filters);

        return $this->redirectToRoute("app_search");
    }


    #[Route("/search/addFilter/{filterRaw}", name: "app_search_addFilter")]
    public function addFilter(Request $request, string $filterRaw): Response
    {
        $filterArray = explode("_", $filterRaw);

        $session = $request->getSession();
        $filters = $session->get("filters");
        $filters[$filterArray[0]] = $filterArray[1];
        $session->set("filters", $filters);

        return $this->redirectToRoute("app_search");
    }


    #[Route("/search/filterAll/{filterRaw}", name: "app_search_filterAll")]
    public function filterAll(Request $request, string $filterRaw): Response
    {
        $session = $request->getSession();
        $session->remove('userInput');
        $session->remove('filters');

        return $this->redirectToRoute('app_search_addFilter', ['filterRaw' => $filterRaw]);
    }
}
