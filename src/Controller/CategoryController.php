<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();
        
        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/show/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findBy(['name' => $categoryName]);
        
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name : '.$categoryName.' found in category table.'
            );
        }

        $programs = $programRepository->findByCategory($category);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // Persist Category Object
            $entityManager->persist($category);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
