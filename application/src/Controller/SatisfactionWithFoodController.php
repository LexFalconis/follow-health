<?php

namespace App\Controller;

use App\Entity\SatisfactionWithFood;
use App\Form\SatisfactionWithFoodType;
use App\Repository\SatisfactionWithFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/satisfaction-with-food')]
class SatisfactionWithFoodController extends AbstractController
{
    #[Route('/', name: 'app_satisfaction_with_food_index', methods: ['GET'])]
    public function index(SatisfactionWithFoodRepository $satisfactionWithFoodRepository): Response
    {
        return $this->render('satisfaction_with_food/index.html.twig', [
            'satisfaction_with_foods' => $satisfactionWithFoodRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_satisfaction_with_food_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SatisfactionWithFoodRepository $satisfactionWithFoodRepository): Response
    {
        $satisfactionWithFood = new SatisfactionWithFood();
        $form = $this->createForm(SatisfactionWithFoodType::class, $satisfactionWithFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $satisfactionWithFoodRepository->save($satisfactionWithFood, true);

            return $this->redirectToRoute('app_satisfaction_with_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('satisfaction_with_food/new.html.twig', [
            'satisfaction_with_food' => $satisfactionWithFood,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_satisfaction_with_food_show', methods: ['GET'])]
    public function show(SatisfactionWithFood $satisfactionWithFood): Response
    {
        return $this->render('satisfaction_with_food/show.html.twig', [
            'satisfaction_with_food' => $satisfactionWithFood,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_satisfaction_with_food_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SatisfactionWithFood $satisfactionWithFood, SatisfactionWithFoodRepository $satisfactionWithFoodRepository): Response
    {
        $form = $this->createForm(SatisfactionWithFoodType::class, $satisfactionWithFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $satisfactionWithFoodRepository->save($satisfactionWithFood, true);

            return $this->redirectToRoute('app_satisfaction_with_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('satisfaction_with_food/edit.html.twig', [
            'satisfaction_with_food' => $satisfactionWithFood,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_satisfaction_with_food_delete', methods: ['POST'])]
    public function delete(Request $request, SatisfactionWithFood $satisfactionWithFood, SatisfactionWithFoodRepository $satisfactionWithFoodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$satisfactionWithFood->getId(), $request->request->get('_token'))) {
            $satisfactionWithFoodRepository->remove($satisfactionWithFood, true);
        }

        return $this->redirectToRoute('app_satisfaction_with_food_index', [], Response::HTTP_SEE_OTHER);
    }
}
