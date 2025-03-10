<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface FileDeleteInterface* Defines the contract for deleting a File.
 */
interface FileDeleteInterface
{
    public function delete(\App\Core\Domain\ValueObject\FileId $id): \App\Core\Domain\ValueObject\FileId;
}
