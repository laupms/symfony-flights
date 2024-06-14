<?php

namespace App\Controller;

use App\Entity\Flights;
use App\Form\FlightsType;
use App\Repository\FlightsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class FlightsController extends AbstractController
{
    #[Route('/', name: 'app_flights_index', methods: ['GET'])]
    public function index(FlightsRepository $flightsRepository): Response
    {
        return $this->renderForm('flights/index.html.twig', [
            'flights' => $flightsRepository->findAll(),
        ]);
    }
}