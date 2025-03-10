<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

/** Exception for Prompt domain errors */
class PromptException extends \Exception
{
    public function __construct(string $message = 'An error occurred in Prompt domain')
    {
        parent::__construct($message);
    }

    public static function because(string $reason): self
    {
        return new self($reason);
    }
}
