<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface FileFindInterface* Defines the contract for querying File entities.
 */
interface FileFindInterface
{
    public function find(\App\Core\Domain\ValueObject\FileId $id): ?\App\Core\Domain\Aggregate\FileModel;

    public function findAll(): array;

    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
