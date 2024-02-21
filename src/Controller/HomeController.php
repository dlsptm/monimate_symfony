<?php

namespace App\Controller;

use App\Service\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(Request $request, MailerInterface $mailer): Response
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


#[Route('/home', name: 'home')]
 public function home ():Response
{
return $this->render('home/home.html.twig');
}
}