<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 08/11/18
 * Time: 08:49
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}")
     */
    public function show(Category $category)
    {
        return $this->render('category.html.twig', ['category' => $category]);
    }

}
