<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Mail;

class Mailer implements \App\Shared\Application\Mail\Mailer
{
    public function send(mixed $message): void
    {
        throw new \Exception('Not implemented ');
    }
}
