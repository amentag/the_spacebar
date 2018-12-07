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

    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache, LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $logger;
    }

    public function parse(string $content): string
    {
        $item = $this->cache->getItem('markdown_' . md5($content));

        if (!$item->isHit()) {
            $this->logger->info('Cache is empty');
            $item->set($this->markdown->transform($content));
            $this->cache->save($item);
        }

        return $item->get();
    }
}