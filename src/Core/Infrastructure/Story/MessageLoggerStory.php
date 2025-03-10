<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Story;

use Zenstruck\Foundry\Story;

/**
 * Class MessageLoggerStory.
 * Story to create 15 instances of MessageLogger using the factory.
 */
final class MessageLoggerStory extends Story
{
    public function build(): void
    {
        \App\Core\Infrastructure\Factory\MessageLoggerFactory::createMany(15);
    }
}
