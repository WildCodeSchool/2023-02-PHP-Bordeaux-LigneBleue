<?php

namespace App\Controller;

use App\Repository\TutorialRepository;
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
        TutorialRepository $tutorialRepository
    ): Response {
        $session = $request->getSession();
        $userInput = $session->get("userInput");

        if (!$userInput) {
            return $this->render('search/index.html.twig');
        }

        $filters = $session->get("filters");
        $tutorials = $tutorialRepository->searchTutorials($userInput, $filters);

        return $this->render('search/index.html.twig', [
            'userInput' => $userInput,
            'tutorials' => $tutorials,
        ]);
    }

    #[Route('/search/form', name: 'app_search_form')]
    public function renderSearchForm(Request $request): Response
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
            ->setAction("/search/form")
            ->getForm();

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $session = $request->getSession();
            $session->remove("userInput");
            $session->remove("filters");

            $searchData = $searchForm->getData()["search"];
            $session->set("userInput", $searchData);

            return $this->redirectToRoute("app_search");
        }

        return $this->render('search/_form.html.twig', [
            'searchForm' => $searchForm
        ]);
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
