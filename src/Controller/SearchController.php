<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Entity\User;
use App\Form\FilterFormType;
use App\Form\SearchBarType;
use App\Repository\TutorialRepository;
use App\Repository\UserRepository;
use App\Repository\UserTutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route("/search", name: "app_search")]
    public function search(
        Request $request,
        TutorialRepository $tutorialRepository,
        UserTutorialRepository $userTutorialRepository,
    ): Response {

        $session = $request->getSession();
        $userInput = $session->get("userInput");
        $filterForm = $this->createForm(FilterFormType::class);

        if (!$userInput) {
            return $this->render('search/index.html.twig');
        }
        $filters = $session->get("filters");
        $tutorials = $tutorialRepository->searchTutorials($userInput, $filters, null);

        $tutorials = $tutorialRepository->findAll();
        $userTutorials = [];
        foreach ($tutorials as $tutorial) {
            $userTutorial = $userTutorialRepository->findOneBy(['tutorial' => $tutorial]);
            $userTutorials[$tutorial->getId()] = $userTutorial;
        }


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

            $searchData = $searchForm->getData()["search"];
            $session->set("userInput", $searchData);

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
}
