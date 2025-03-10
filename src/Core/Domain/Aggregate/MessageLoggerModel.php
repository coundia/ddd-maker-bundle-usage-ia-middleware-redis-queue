<?php

declare(strict_types=1);

namespace App\Core\Domain\Aggregate;

use App\Core\Domain\ValueObject\MessageLoggerId;
use App\Core\Domain\ValueObject\MessageLoggerMessage;
use App\Core\Domain\ValueObject\MessageLoggerRequestId;
use App\Core\Domain\ValueObject\MessageLoggerStatus;
use App\Shared\Domain\Aggregate\AggregateRoot;

/**
 * Class MessageLogger* Aggregate Root of the MessageLogger context.
 */
class MessageLoggerModel extends AggregateRoot
{
    public function __construct(
        public ?MessageLoggerMessage $message,
        public ?MessageLoggerStatus $status,
        public ?MessageLoggerRequestId $requestId,
        public ?MessageLoggerId $id,
    ) {
    }

    public static function create(
        ?MessageLoggerMessage $message,
        ?MessageLoggerStatus $status,
        ?MessageLoggerRequestId $requestId,
        ?MessageLoggerId $id,
    ): self {
        return new self(
            $message,
            $status,
            $requestId,
            $id,
        );
    }

    public function update(
        ?MessageLoggerMessage $message,
        ?MessageLoggerStatus $status,
        ?MessageLoggerRequestId $requestId,
        ?MessageLoggerId $id,
    ): self {
        return new self(
            $message,
            $status,
            $requestId,
            $id,
        );
    }
}
