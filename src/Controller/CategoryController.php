<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'insert_category')]
    #[Route('/category/{id}', name: 'update_category')]
    public function index(CategoryRepository $repo, EntityManagerInterface $manager, Request $request, $id=null): Response
    {
        if ($id) {
            $category = $repo->find($id);
        } else {
            $category = New Category();
        }

        // affichage de tous les catégories
        $categories = $repo->findAll();

            // génération de formulaire à partir de la classe CategoryFormType
            $form = $this->createForm(CategoryType::class, $category);
            
            // ici on va gérer la requête entrante
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                // on crée une instance de la classe Category à laquelle on passe ces valeurs
                // on récupère les valeurs du formulaire 
                $category = $form->getData();

                // On persiste les valeurs
                $manager->persist($category);

                // On exécute la transaction
                $manager->flush();

                return $this->redirectToRoute('insert_category');
            }

        return $this->render('category/index.html.twig',
            compact('category', 'categories', 'form'));
    }
}
