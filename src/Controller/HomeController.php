<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/legal', name: 'legal')]
     public function legal ():Response
    {
    return $this->render('home/legal.html.twig');
    }

    #[Route('/conditions', name: 'conditions')]
     public function conditions ():Response
    {
    return $this->render('home/conditions.html.twig');
    }
}
