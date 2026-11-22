<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class InscribeController extends AbstractController
{
    #[Route('/', name: 'app_inscribe')]
    public function index(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $inscribe = new User();
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $inscribe = $form->getData();
            $inscribe->setRoles['ROLE_USER'];
            $entityManager->persist($inscribe);
            $entityManager->flush();

            return $this->redirectToRoute('app_success');
        }

        return $this->render('inscribe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/inscribe/sucess', name: 'app_success')]
    public function success(UserRepository $userRepository, Request $request, Response $response): Response
    {
        $sucessMessage = 'je inschrijving is gelukt veel plezier!';
        return $this->render('inscribe/sucess.html.twig', [
            'sucessMessage' => $sucessMessage,
        ]);
    }
}
