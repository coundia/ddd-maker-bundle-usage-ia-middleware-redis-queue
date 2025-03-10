<?php

declare(strict_types=1);

namespace App\Shared\Application\Mail;

interface Mailer
{
    public function send(mixed $message): void;
}
