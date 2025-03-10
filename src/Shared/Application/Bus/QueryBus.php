<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus;

interface QueryBus
{
    public function dispatch(object $message, array $stamps = []): mixed;
}
