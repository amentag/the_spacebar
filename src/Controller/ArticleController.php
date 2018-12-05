<?php

namespace App\Controller;

use Michelf\MarkdownInterface;
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
    public function show(int $id, MarkdownInterface $markdown)
    {
        return $this->render('article/show.html.twig', [
            'id' => $id,
            'content' => $markdown->transform($this->getText())
        ]);
    }

    protected function getText()
    {
        return 'Spicy ***jalapeno*** bacon ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
                lorem proident **beef** ribs aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
                labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
                *turkey* shank eu pork belly meatball non cupim.';
    }
}
