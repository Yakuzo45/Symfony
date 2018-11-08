<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 08/11/18
 * Time: 14:39
 */

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}")
     */
    public function show(Category $category)
    {
        return $this->render('category.html.twig', ['category' => $category->getName(), 'articles'=> $category->getArticles()]);
    }
}