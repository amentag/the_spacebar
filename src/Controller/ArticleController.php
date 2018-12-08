<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Nexy\Slack\Attachment;
use Nexy\Slack\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repository)
    {
        return $this->render('article/index.html.twig', [
            'articles' => $repository->findAll()
        ]);
    }
    /**
     * @Route("/article/{slug}", name="article.show")
     */
    public function show(string $slug, bool $isDebug, SlackClient $slackClient, ArticleRepository $repository)
    {
        dump($isDebug);


        $article = $repository->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException(sprintf("No article for slug %s", $slug));
        }

        if ($article->getId() === 1) {
            $slackClient->sendMessage('bob marley', 'Bonus! LoggerTrait & Setter Injection');
        }


        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    protected function getText()
    {
        return 'Spicy ***jalapeno*** bacon ipsum dolor amet veniam [White Bear](http://fr.onepiece.wikia.com/wiki/Edward_Newgate) in dolore. Ham hock nisi landjaeger cow,
                lorem proident **beef** ribs aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
                labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
                *turkey* shank eu pork belly meatball non cupim.';
    }
}
