<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Aggregate\PromptModel;
use App\Core\Domain\ValueObject\PromptId;

interface PromptRepositoryInterface
{
    public function save(PromptModel $prompt): PromptModel;

    public function update(PromptModel $prompt, PromptId $id): PromptModel;

    public function delete(PromptId $prompt): PromptId;

    public function findById(PromptId $id): ?PromptModel;

    /**
     * @return array<\App\Core\Domain\Aggregate\PromptModel>
     */
    public function findAll(): array;

    /**
     * @return array<\App\Core\Domain\Aggregate\PromptModel>
     */
    public function findByCriteria(array $criteria): array;

    /**
     * @return array{
     *     items: array<\App\Core\Domain\Aggregate\PromptModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
