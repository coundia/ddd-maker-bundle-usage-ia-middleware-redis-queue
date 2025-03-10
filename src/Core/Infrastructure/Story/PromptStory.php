<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Story;

use Zenstruck\Foundry\Story;

/**
 * Class PromptStory.
 * Story to create 15 instances of Prompt using the factory.
 */
final class PromptStory extends Story
{
    public function build(): void
    {
        \App\Core\Infrastructure\Factory\PromptFactory::createMany(15);
    }
}
