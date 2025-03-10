<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface MessageLoggerFindInterface* Defines the contract for querying MessageLogger entities.
 */
interface MessageLoggerFindInterface
{
    public function find(\App\Core\Domain\ValueObject\MessageLoggerId $id): ?\App\Core\Domain\Aggregate\MessageLoggerModel;

    public function findAll(): array;

    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
