<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface MessageLoggerCreateInterface* Defines the contract for creating a MessageLogger.
 */
interface MessageLoggerCreateInterface
{
    public function create(\App\Core\Domain\Aggregate\MessageLoggerModel $messageLogger): \App\Core\Domain\Aggregate\MessageLoggerModel;
}
