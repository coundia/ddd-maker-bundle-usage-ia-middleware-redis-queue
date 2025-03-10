<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DataFixtures;

use App\Core\Infrastructure\Story\FileStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class FileFixtures.
 * Seeds the database with initial data using the story.
 */
class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        FileStory::load();
    }
}
