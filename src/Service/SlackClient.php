<?php

namespace App\Service;

use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;

    public function __construct(Client $client)
    {
        $this->slack = $client;
    }

    public function sendMessage(string $sender, string $content)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $content
        ]);

        $message = $this->slack->createMessage();

        $message
            ->from($sender)
            ->withIcon(':ghost:')
            ->setText($content)
        ;

        $this->slack->sendMessage($message);
    }
}