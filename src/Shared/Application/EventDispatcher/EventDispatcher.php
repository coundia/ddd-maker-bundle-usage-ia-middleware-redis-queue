<?php

declare(strict_types=1);

namespace App\Shared\Application\EventDispatcher;

interface EventDispatcher
{
    public function dispatch(array $events): void;
}
