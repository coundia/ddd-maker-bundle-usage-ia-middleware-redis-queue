<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Story;

use Zenstruck\Foundry\Story;

/**
 * Class FileStory.
 * Story to create 15 instances of File using the factory.
 */
final class FileStory extends Story
{
    public function build(): void
    {
        \App\Core\Infrastructure\Factory\FileFactory::createMany(15);
    }
}
