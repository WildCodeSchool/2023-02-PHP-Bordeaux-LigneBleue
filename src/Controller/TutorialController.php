<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Entity\UserTutorial;
use App\Form\TutorialType;
use App\Repository\TutorialRepository;
use App\Repository\UserRepository;
use App\Repository\UserTutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/tutorial')]
class TutorialController extends AbstractController
{
    #[Route('/', name: 'app_tutorial_index', methods: ['GET'])]
    public function index(TutorialRepository $tutorialRepository): Response
    {
        return $this->render('tutorial/index.html.twig', [
            'tutorials' => $tutorialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tutorial_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TutorialRepository $tutorialRepository, SluggerInterface $slugger): Response
    {
        $tutorial = new Tutorial();
        $form = $this->createForm(TutorialType::class, $tutorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($tutorial->getTitle());
            $tutorial->setSlug($slug);
            $tutorialRepository->save($tutorial, true);

            return $this->redirectToRoute('app_tutorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tutorial/new.html.twig', [
            'tutorial' => $tutorial,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_tutorial_show', methods: ['GET'])]
    public function show(Tutorial $tutorial, UserTutorialRepository $utRepository): Response
    {
        return $this->render('tutorial/show.html.twig', [
            'tutorial' => $tutorial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tutorial_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tutorial $tutorial, TutorialRepository $tutorialRepository): Response
    {
        $form = $this->createForm(TutorialType::class, $tutorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tutorialRepository->save($tutorial, true);

            return $this->redirectToRoute('app_tutorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tutorial/edit.html.twig', [
            'tutorial' => $tutorial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tutorial_delete', methods: ['POST'])]
    public function delete(Request $request, Tutorial $tutorial, TutorialRepository $tutorialRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tutorial->getId(), $request->request->get('_token'))) {
            $tutorialRepository->remove($tutorial, true);
        }

        return $this->redirectToRoute('app_tutorial_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/like/{slug}', name: 'app_tutorial_like', methods: ['GET'])]
    public function likedTutorial(
        Tutorial $tutorial,
        UserTutorialRepository $utRepository,
        UserRepository $userRepository
    ): Response {

        $user = $this->getUser();

        if ($user == null) {
            $this->addFlash('danger', 'Vous devez être connecté pour sauvegarder une formation.');
        }

        $userTutorial = $utRepository->findOne($user, $tutorial);

        if ($userTutorial) {
            if (true === $userTutorial->isIsLiked()) {
                $userTutorial->setIsLiked(false);
            } else {
                $userTutorial->setIsLiked(true);
            }
        } else {
            $userTutorial = new UserTutorial(false, true, false);
            $userTutorial->setUser($this->getUser());
            $userTutorial->setTutorial($tutorial);
            $user->addUserTutorial($userTutorial);
        }

        $userTutorial->setUpdatedAt(new \DateTime('now'));
        $utRepository->save($userTutorial, true);
        $userRepository->save($user, true);

        return $this->json([
            'isLiked' => $this->getUser()->isInUserTutorialLiked($tutorial)
        ]);
    }

    #[Route('/start/{slug}', name: 'app_tutorial_start', methods: ['GET'])]
    public function startTutorial(
        Tutorial $tutorial,
        UserTutorialRepository $utRepository,
        UserRepository $userRepository
    ): Response {

        $user = $this->getUser();
        if ($user) {
            $userTutorial = $utRepository->findOne($user, $tutorial);
            if ($userTutorial) {
                if (false === $userTutorial->getIsStarted()) {
                    $userTutorial->setIsStarted(true);
                }
            } else {
                $userTutorial = new UserTutorial(true, false, false);
                $userTutorial->setUser($this->getUser());
                $userTutorial->setTutorial($tutorial);
                $user->addUserTutorial($userTutorial);
            }
            $userTutorial->setUpdatedAt(new \DateTime('now'));
            $utRepository->save($userTutorial, true);
            $userRepository->save($user, true);
        }
        return $this->json([
            'isStarted' => true,
        ]);
    }
}
