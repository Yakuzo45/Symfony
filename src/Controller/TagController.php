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

class TagController extends AbstractController
{
    /**
     * @Route("/tag/{name}", name="blog_tag")
     */
    public function show(Tag $tag): Response
    {
        return $this->render('blog/tag.html.twig', [
            'tag' => $tag,
            'articles' => $tag->getArticles(),
        ]);
    }
}