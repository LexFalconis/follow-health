<?php

namespace App\Controller;

use App\Entity\FoodDiary;
use App\Form\FoodDiaryType;
use App\Repository\FoodDiaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/food-diary')]
class FoodDiaryController extends AbstractController
{
    #[Route('/', name: 'app_food_diary_index', methods: ['GET'])]
    public function index(FoodDiaryRepository $foodDiaryRepository): Response
    {
        return $this->render('food_diary/index.html.twig', [
            'food_diaries' => $foodDiaryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_food_diary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FoodDiaryRepository $foodDiaryRepository): Response
    {
        $foodDiary = new FoodDiary();
        $form = $this->createForm(FoodDiaryType::class, $foodDiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodDiaryRepository->save($foodDiary, true);

            return $this->redirectToRoute('app_food_diary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('food_diary/new.html.twig', [
            'food_diary' => $foodDiary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_food_diary_show', methods: ['GET'])]
    public function show(FoodDiary $foodDiary): Response
    {
        return $this->render('food_diary/show.html.twig', [
            'food_diary' => $foodDiary,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_food_diary_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FoodDiary $foodDiary, FoodDiaryRepository $foodDiaryRepository): Response
    {
        $form = $this->createForm(FoodDiaryType::class, $foodDiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodDiaryRepository->save($foodDiary, true);

            return $this->redirectToRoute('app_food_diary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('food_diary/edit.html.twig', [
            'food_diary' => $foodDiary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_food_diary_delete', methods: ['POST'])]
    public function delete(Request $request, FoodDiary $foodDiary, FoodDiaryRepository $foodDiaryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foodDiary->getId(), $request->request->get('_token'))) {
            $foodDiaryRepository->remove($foodDiary, true);
        }

        return $this->redirectToRoute('app_food_diary_index', [], Response::HTTP_SEE_OTHER);
    }
}
