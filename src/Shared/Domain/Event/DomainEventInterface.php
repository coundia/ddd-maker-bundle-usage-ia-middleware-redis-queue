<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

/** Base interface for all domain events */
interface DomainEventInterface
{
    public function occurredOn(): \DateTimeImmutable;
}
