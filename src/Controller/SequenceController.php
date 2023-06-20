<?php

namespace App\Controller;

use App\Entity\Sequence;
use App\Form\SequenceType;
use App\Repository\SequenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sequence')]
class SequenceController extends AbstractController
{
    #[Route('/', name: 'app_sequence_index', methods: ['GET'])]
    public function index(SequenceRepository $sequenceRepository): Response
    {
        return $this->render('sequence/index.html.twig', [
            'sequences' => $sequenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sequence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SequenceRepository $sequenceRepository): Response
    {
        $sequence = new Sequence();
        $form = $this->createForm(SequenceType::class, $sequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sequenceRepository->save($sequence, true);

            return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sequence/new.html.twig', [
            'sequence' => $sequence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sequence_show', methods: ['GET'])]
    public function show(Sequence $sequence): Response
    {
        return $this->render('sequence/show.html.twig', [
            'sequence' => $sequence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sequence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sequence $sequence, SequenceRepository $sequenceRepository): Response
    {
        $form = $this->createForm(SequenceType::class, $sequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sequenceRepository->save($sequence, true);

            return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sequence/edit.html.twig', [
            'sequence' => $sequence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sequence_delete', methods: ['POST'])]
    public function delete(Request $request, Sequence $sequence, SequenceRepository $sequenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sequence->getId(), $request->request->get('_token'))) {
            $sequenceRepository->remove($sequence, true);
        }

        return $this->redirectToRoute('app_sequence_index', [], Response::HTTP_SEE_OTHER);
    }
}
