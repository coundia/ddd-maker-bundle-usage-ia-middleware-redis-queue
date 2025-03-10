<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface PromptFindInterface* Defines the contract for querying Prompt entities.
 */
interface PromptFindInterface
{
    public function find(\App\Core\Domain\ValueObject\PromptId $id): ?\App\Core\Domain\Aggregate\PromptModel;

    public function findAll(): array;

    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
