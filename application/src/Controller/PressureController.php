<?php

namespace App\Controller;

use App\Entity\Pressure;
use App\Form\PressureType;
use App\Repository\PressureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pressure')]
class PressureController extends AbstractController
{
    #[Route('/', name: 'app_pressure_index', methods: ['GET'])]
    public function index(PressureRepository $pressureRepository): Response
    {
        return $this->render('pressure/index.html.twig', [
            'pressures' => $pressureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pressure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PressureRepository $pressureRepository): Response
    {
        $pressure = new Pressure();
        $form = $this->createForm(PressureType::class, $pressure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pressureRepository->save($pressure, true);

            return $this->redirectToRoute('app_pressure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pressure/new.html.twig', [
            'pressure' => $pressure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pressure_show', methods: ['GET'])]
    public function show(Pressure $pressure): Response
    {
        return $this->render('pressure/show.html.twig', [
            'pressure' => $pressure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pressure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pressure $pressure, PressureRepository $pressureRepository): Response
    {
        $form = $this->createForm(PressureType::class, $pressure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pressureRepository->save($pressure, true);

            return $this->redirectToRoute('app_pressure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pressure/edit.html.twig', [
            'pressure' => $pressure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pressure_delete', methods: ['POST'])]
    public function delete(Request $request, Pressure $pressure, PressureRepository $pressureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pressure->getId(), $request->request->get('_token'))) {
            $pressureRepository->remove($pressure, true);
        }

        return $this->redirectToRoute('app_pressure_index', [], Response::HTTP_SEE_OTHER);
    }
}
