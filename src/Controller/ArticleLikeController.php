<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleLikeController extends AbstractController
{
    /**
     * @Route("/article/{id}/like", name="article_like.new", methods={"POST"})
     */
    public function new(int $id, Request $request)
    {
        $heart = $request->request->get('heart');

        return $this->json(['heart' => ++$heart]);
    }
}
