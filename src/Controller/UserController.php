<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Entity\User;
use App\Form\AvatarChoiceType;
use App\Form\UserType;
use App\Repository\TutorialRepository;
use App\Repository\UserRepository;
use App\Repository\UserTutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user', name: 'app_user')]
class UserController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute(
                'app_user_show',
                ['user' => $user, 'id' => $user->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'userType' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(
        User $user,
        UserTutorialRepository $utRepository,
        TutorialRepository $tutorialRepository,
    ): Response {
        $user = $this->getUser();
        $utStarted = $utRepository->findThreeLastStarted($user);
        $allUserTutorials = $utRepository->findAllByUser($user);
        $allTutorials = $tutorialRepository->findAll();
        $allTutorialsLessUT = array_diff($allTutorials, $allUserTutorials);
        $randomKeys = array_rand($allTutorialsLessUT, 3);
        $associatedTutorials = [];
        for ($i = 0; $i < 3; $i++) {
            $associatedTutorials[] = $allTutorialsLessUT[$randomKeys[$i]];
        }


        return $this->render('user/show.html.twig', [
            'user' => $user,
            'utStarted' => $utStarted,
            'associatedTutorials' => $associatedTutorials,
        ]);
    }

    #[Route('/{id/formations-enregistrees}', name: '_show_valid', methods: ['GET'])]
    public function showLikedTutorials(UserTutorialRepository $utRepository): Response
    {
        $user = $this->getUser();
        $utLiked = $utRepository->findAllLiked($user);
        return $this->render('user/show_validated.html.twig', [
            'user' => $user,
            'utLiked' => $utLiked,
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        $session = new Session();
        $session->invalidate();

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/edit_avatar', name: '_edit_avatar')]
    public function editAvatar(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvatarChoiceType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the selected avatar choice
            $selectedAvatar = $form->get('avatar')->getData();

            // Update the avatar path in the User entity
            $user->setAvatar($selectedAvatar);

            // Persist the changes to the User entity in the database
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit_avatar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/tutorial_completed', name: '_tutorial_completed')]
    public function tutorialCompleted(User $user, UserRepository $userRepository): Response
    {
        $userTutorials = $userRepository->findUserTutorialsIsValidated($user);

        return $this->render('user/tuto_completed.html.twig', [
            'user' => $user,
            'userTutorials' => $userTutorials,
        ]);
    }
}
