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

    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache, LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }

    public function parse(string $content): string
    {
        if ($this->isDebug) {
            $this->logger->info('It is debug mode');
            return $this->markdown->transform($content);
        }

        $item = $this->cache->getItem('markdown_' . md5($content));

        if (!$item->isHit()) {
            $this->logger->info('Cache is empty');
            $item->set($this->markdown->transform($content));
            $this->cache->save($item);
        }

        return $item->get();
    }
}