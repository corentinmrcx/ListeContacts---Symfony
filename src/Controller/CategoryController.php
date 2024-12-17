<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAllOrderedByNameWithContactCount();

        return $this->render('category/index.html.twig', [
            'allCategory' => $category,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(?Category $category, ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findBy(['category' => $category]);

        return $this->render('category/show.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
