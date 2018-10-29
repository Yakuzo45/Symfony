<?php
/**
 * Created by PhpStorm.
 * User: wilder7
 * Date: 29/10/18
 * Time: 11:12
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    const NON_AUTHORIZED_CHAR = '/[A-Z_]/';
    /**
     * @Route("/blog/{content}", name="blog_list")
     */
    public function show($content = 'article-sans-titre')
    {
        if (preg_match(self::NON_AUTHORIZED_CHAR, $content)) {
            $content = 'ERROR 404';
        } else {
            $content = str_replace('-',' ',$content);
            $content = ucwords($content,' ');
        }
        return $this->render('home.html.twig', ['content' => $content]);
    }
}