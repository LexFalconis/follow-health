<?php

namespace App\Controller;

use App\Entity\Diabetes;
use App\Form\DiabetesType;
use App\Repository\DiabetesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/diabetes')]
class DiabetesController extends AbstractController
{
    #[Route('/', name: 'app_diabetes_index', methods: ['GET'])]
    public function index(DiabetesRepository $diabetesRepository): Response
    {
        return $this->render('diabetes/index.html.twig', [
            'diabetes' => $diabetesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_diabetes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiabetesRepository $diabetesRepository): Response
    {
        $diabetes = new Diabetes();
        $form = $this->createForm(DiabetesType::class, $diabetes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diabetesRepository->save($diabetes, true);

            return $this->redirectToRoute('app_diabetes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diabetes/new.html.twig', [
            'diabetes' => $diabetes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diabetes_show', methods: ['GET'])]
    public function show(Diabetes $diabetes): Response
    {
        return $this->render('diabetes/show.html.twig', [
            'diabetes' => $diabetes,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_diabetes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Diabetes $diabetes, DiabetesRepository $diabetesRepository): Response
    {
        $form = $this->createForm(DiabetesType::class, $diabetes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diabetesRepository->save($diabetes, true);

            return $this->redirectToRoute('app_diabetes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diabetes/edit.html.twig', [
            'diabetes' => $diabetes,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diabetes_delete', methods: ['POST'])]
    public function delete(Request $request, Diabetes $diabetes, DiabetesRepository $diabetesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diabetes->getId(), $request->request->get('_token'))) {
            $diabetesRepository->remove($diabetes, true);
        }

        return $this->redirectToRoute('app_diabetes_index', [], Response::HTTP_SEE_OTHER);
    }
}
