<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [

        ]);
    }
    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show(int $id)
    {
        return $this->render('article/show.html.twig', [
            'id' => $id
        ]);
    }
}
