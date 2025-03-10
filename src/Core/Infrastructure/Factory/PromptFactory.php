<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Factory;

use App\Entity\Prompt;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * Class PromptFactory.
 * Creates Prompt entities for testing purposes.
 * Uses Zenstruck Foundry to generate persistent test data.
 */
final class PromptFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Prompt::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'prompt' => self::faker()->sentence(),
            'userId' => self::faker()->sentence(),
            'requestId' => self::faker()->sentence(),
        ];
    }

    protected function initialize(): static
    {
        return $this;
    }
}
