<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Factory;

use App\Entity\MessageLogger;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * Class MessageLoggerFactory.
 * Creates MessageLogger entities for testing purposes.
 * Uses Zenstruck Foundry to generate persistent test data.
 */
final class MessageLoggerFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return MessageLogger::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'message' => self::faker()->sentence(),
            'status' => self::faker()->sentence(),
            'requestId' => self::faker()->sentence(),
        ];
    }

    protected function initialize(): static
    {
        return $this;
    }
}
