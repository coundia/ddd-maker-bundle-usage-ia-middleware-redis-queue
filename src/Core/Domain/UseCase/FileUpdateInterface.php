<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface FileUpdateInterface* Defines the contract for updating File entities.
 */
interface FileUpdateInterface
{
    public function update(\App\Core\Domain\Aggregate\FileModel $entity, \App\Core\Domain\ValueObject\FileId $entityId): \App\Core\Domain\Aggregate\FileModel;
}
