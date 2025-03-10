<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Factory;

use App\Entity\File;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * Class FileFactory.
 * Creates File entities for testing purposes.
 * Uses Zenstruck Foundry to generate persistent test data.
 */
final class FileFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return File::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'filename' => self::faker()->sentence(),
            'filePath' => self::faker()->sentence(),
        ];
    }

    protected function initialize(): static
    {
        return $this;
    }
}
