<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface FileCreateInterface* Defines the contract for creating a File.
 */
interface FileCreateInterface
{
    public function create(\App\Core\Domain\Aggregate\FileModel $file): \App\Core\Domain\Aggregate\FileModel;
}
