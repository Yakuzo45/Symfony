<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 29/10/18
 * Time: 11:12
 */

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    const NON_AUTHORIZED_CHAR = '/[A-Z_]/';
    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/show/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     */
    public function show($slug)
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['name' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article
            ]
        );
    }


    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @Route("/category/{category}", name="blog_show_category")
     * @param string $category
     */
    public function showByCategory(string $category)
    {
        $catego = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => mb_strtolower($category)]);

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $catego->getId()], ['id' => 'ASC'] , 3);

        if (!$category) {
            throw $this->createNotFoundException(
                'No article with '.$category.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $catego,
                'articles' => $articles,
            ]
        );
    }
}