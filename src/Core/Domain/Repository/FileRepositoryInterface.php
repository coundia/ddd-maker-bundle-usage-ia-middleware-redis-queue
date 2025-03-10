<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Aggregate\FileModel;
use App\Core\Domain\ValueObject\FileId;

interface FileRepositoryInterface
{
    public function save(FileModel $file): FileModel;

    public function update(FileModel $file, FileId $id): FileModel;

    public function delete(FileId $file): FileId;

    public function findById(FileId $id): ?FileModel;

    /**
     * @return array<\App\Core\Domain\Aggregate\FileModel>
     */
    public function findAll(): array;

    /**
     * @return array<\App\Core\Domain\Aggregate\FileModel>
     */
    public function findByCriteria(array $criteria): array;

    /**
     * @return array{
     *     items: array<\App\Core\Domain\Aggregate\FileModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
