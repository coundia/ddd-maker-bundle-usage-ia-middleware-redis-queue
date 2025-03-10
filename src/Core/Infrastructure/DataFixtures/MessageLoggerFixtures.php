<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DataFixtures;

use App\Core\Infrastructure\Story\MessageLoggerStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class MessageLoggerFixtures.
 * Seeds the database with initial data using the story.
 */
class MessageLoggerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MessageLoggerStory::load();
    }
}
