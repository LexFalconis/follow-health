<?php

namespace App\Controller;

use App\Entity\TypeOfMeal;
use App\Form\TypeOfMealType;
use App\Repository\TypeOfMealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type-of-meal')]
class TypeOfMealController extends AbstractController
{
    #[Route('/', name: 'app_type_of_meal_index', methods: ['GET'])]
    public function index(TypeOfMealRepository $typeOfMealRepository): Response
    {
        return $this->render('type_of_meal/index.html.twig', [
            'type_of_meals' => $typeOfMealRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_of_meal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeOfMealRepository $typeOfMealRepository): Response
    {
        $typeOfMeal = new TypeOfMeal();
        $form = $this->createForm(TypeOfMealType::class, $typeOfMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeOfMealRepository->save($typeOfMeal, true);

            return $this->redirectToRoute('app_type_of_meal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_of_meal/new.html.twig', [
            'type_of_meal' => $typeOfMeal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_meal_show', methods: ['GET'])]
    public function show(TypeOfMeal $typeOfMeal): Response
    {
        return $this->render('type_of_meal/show.html.twig', [
            'type_of_meal' => $typeOfMeal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_of_meal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeOfMeal $typeOfMeal, TypeOfMealRepository $typeOfMealRepository): Response
    {
        $form = $this->createForm(TypeOfMealType::class, $typeOfMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeOfMealRepository->save($typeOfMeal, true);

            return $this->redirectToRoute('app_type_of_meal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_of_meal/edit.html.twig', [
            'type_of_meal' => $typeOfMeal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_meal_delete', methods: ['POST'])]
    public function delete(Request $request, TypeOfMeal $typeOfMeal, TypeOfMealRepository $typeOfMealRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfMeal->getId(), $request->request->get('_token'))) {
            $typeOfMealRepository->remove($typeOfMeal, true);
        }

        return $this->redirectToRoute('app_type_of_meal_index', [], Response::HTTP_SEE_OTHER);
    }
}
