<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

/** Exception for MessageLogger domain errors */
class MessageLoggerException extends \Exception
{
    public function __construct(string $message = 'An error occurred in MessageLogger domain')
    {
        parent::__construct($message);
    }

    public static function because(string $reason): self
    {
        return new self($reason);
    }
}
