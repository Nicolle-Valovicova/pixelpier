<?php

namespace App\Controller;

use App\Entity\Workshops;
use App\Repository\WorkshopsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

final class WorkshopController extends AbstractController
{
    #[Route('/workshop', name: 'app_workshop')]
    public function index(Workshops $workshops): Response
    {
        return $this->render('workshop/index.html.twig', [
            'workshops' => $workshops,
        ]);
    }
    #[Route('/workshop/programma', name: 'app_workshop_programma')]
    public function programma(WorkshopsRepository $workshopsRepository): Response
    {
        $workshops = $workshopsRepository->findAll();
        return $this->render('workshop/programma.html.twig', [
            'workshops' => $workshops,
        ]);
    }
}
