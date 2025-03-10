<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\MessageLogger;

use App\Core\Domain\Aggregate\MessageLoggerModel;
use App\Entity\MessageLogger;

interface MessageLoggerMapperInterface
{
    public function fromEntity(MessageLogger $entity): MessageLoggerModel;

    public function toEntity(MessageLoggerModel $model): MessageLogger;

    public function fromArray(array $data): MessageLoggerModel;

    public function toArray(MessageLoggerModel $model): array;
}
