<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 08/11/18
 * Time: 14:39
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleTagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}")
     */
    public function show(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleTagType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

        }

        return $this->render('blog/article.html.twig', [
            'article' => $article,
            'tags' => $article->getTags(),
            'form' => $form->createView(),
        ]);
    }
}