<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 08/11/18
 * Time: 14:39
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
use App\Form\ArticleTagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{name}", name="blog_article")
     */
    public function show(Article $article): Response
    {
        return $this->render('blog/article.html.twig', [
            'article' => $article,
            'tags' => $article->getTags(),
        ]);
    }
}