<?php

declare(strict_types=1);

namespace App\Core\Domain\Repository;

use App\Core\Domain\Aggregate\MessageLoggerModel;
use App\Core\Domain\ValueObject\MessageLoggerId;

interface MessageLoggerRepositoryInterface
{
    public function save(MessageLoggerModel $messagelogger): MessageLoggerModel;

    public function update(MessageLoggerModel $messagelogger, MessageLoggerId $id): MessageLoggerModel;

    public function delete(MessageLoggerId $messagelogger): MessageLoggerId;

    public function findById(MessageLoggerId $id): ?MessageLoggerModel;

    /**
     * @return array<\App\Core\Domain\Aggregate\MessageLoggerModel>
     */
    public function findAll(): array;

    /**
     * @return array<\App\Core\Domain\Aggregate\MessageLoggerModel>
     */
    public function findByCriteria(array $criteria): array;

    /**
     * @return array{
     *     items: array<\App\Core\Domain\Aggregate\MessageLoggerModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array;
}
