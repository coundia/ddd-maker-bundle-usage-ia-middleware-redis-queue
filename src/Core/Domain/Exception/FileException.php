<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

/** Exception for File domain errors */
class FileException extends \Exception
{
    public function __construct(string $message = 'An error occurred in File domain')
    {
        parent::__construct($message);
    }

    public static function because(string $reason): self
    {
        return new self($reason);
    }
}
