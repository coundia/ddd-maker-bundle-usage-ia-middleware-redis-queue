<?php

declare(strict_types=1);

namespace App\Core\Application\Command;

/**
 * Class CreateMessageLoggerCommand Represents a command for creating a MessageLogger.
 */
class CreateMessageLoggerCommand
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\MessageLoggerMessage $message,
        public ?\App\Core\Domain\ValueObject\MessageLoggerStatus $status,
        public ?\App\Core\Domain\ValueObject\MessageLoggerRequestId $requestId,
    ) {
    }
}
