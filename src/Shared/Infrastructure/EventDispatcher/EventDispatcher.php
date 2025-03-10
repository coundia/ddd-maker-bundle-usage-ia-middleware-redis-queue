<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventDispatcher;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements \App\Shared\Application\EventDispatcher\EventDispatcher
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    #[\Override]
    public function dispatch(array $events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event, $event::class);
        }
    }
}
