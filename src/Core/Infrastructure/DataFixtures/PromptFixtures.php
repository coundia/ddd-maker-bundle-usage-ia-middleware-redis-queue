<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DataFixtures;

use App\Core\Infrastructure\Story\PromptStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class PromptFixtures.
 * Seeds the database with initial data using the story.
 */
class PromptFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PromptStory::load();
    }
}
