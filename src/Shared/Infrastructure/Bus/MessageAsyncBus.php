<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Bus\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageAsyncBus implements MessageBus
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function dispatch(MessageAsync $message): void
    {
        $this->messageBus->dispatch($message);
    }
}
