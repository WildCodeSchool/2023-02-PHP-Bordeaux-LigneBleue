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
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, TutorialRepository $tutorialRepository): Response
    {
        $searchForm = $this->createFormBuilder()
            ->add("search", TextType::class, [
                'label' => false,
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
}