<?php


namespace App\Helper;


use Psr\Log\LoggerInterface;

trait LoggerTrait
{
    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    protected function logInfo(string $message, array $context = [])
    {
        if (!$this->logger) {
            return;
        }
        $this->logger->info($message, $context);
    }

    /**
     * @required
     */
    public function setLogger(?LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }
}