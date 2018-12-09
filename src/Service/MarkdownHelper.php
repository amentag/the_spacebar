<?php

namespace App\Service;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    /**
     * @var AdapterInterface
     */
    private $cache;
    /**
     * @var MarkdownInterface
     */
    private $markdown;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * @todo documentations
     *
     * Depuis la version symfony 4.2, il est maintenant possible d'injecter des valeurs de type scalaire par le biais de l'autowiring.
     * Il faudra au préalable l'ajouter dans le bind du fichier services.yaml
     * Exemple:
     *    services:
     *      _defaults:
     *        bind:
     *          $isDebug: '%kernel.debug%'
     */
    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache, LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }

    public function parse(string $content): string
    {
        // todo: enable this code to disable cache to dev env
//        if ($this->isDebug) {
//            $this->logger->info('It is debug mode');
//            return $this->markdown->transform($content);
//        }

        $item = $this->cache->getItem('markdown_' . md5($content));

        if (!$item->isHit()) {
            $this->logger->info('Cache is empty');
            $item->set($this->markdown->transform($content));
            $this->cache->save($item);
        }

        return $item->get();
    }
}