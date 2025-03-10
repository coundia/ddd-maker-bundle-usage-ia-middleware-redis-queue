<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface MessageLoggerDeleteInterface* Defines the contract for deleting a MessageLogger.
 */
interface MessageLoggerDeleteInterface
{
    public function delete(\App\Core\Domain\ValueObject\MessageLoggerId $id): \App\Core\Domain\ValueObject\MessageLoggerId;
}
