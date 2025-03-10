<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBus implements \App\Shared\Application\Bus\QueryBus
{
    public function __construct(private MessageBusInterface $queryBus)
    {
    }

    public function dispatch(object $query, array $stamps = []): mixed
    {
        $envelope = $this->queryBus->dispatch($query);
        $handledStamp = $envelope->last(HandledStamp::class);

        if (!$handledStamp) {
            throw new \RuntimeException(sprintf('No handler found for query of type "%s".', $query::class));
        }

        return $handledStamp->getResult();
    }
}
