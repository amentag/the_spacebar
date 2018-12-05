<?php

namespace App\Service;

use Michelf\MarkdownInterface;
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

    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
    }

    public function parse(string $content): string
    {
        $item = $this->cache->getItem('markdown_' . md5($content));

        if (!$item->isHit()) {
            $item->set($this->markdown->transform($content));
            $this->cache->save($item);
        }

        return $item->get();
    }
}