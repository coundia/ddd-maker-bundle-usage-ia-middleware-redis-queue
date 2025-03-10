<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\MessageLogger;

use App\Core\Domain\Aggregate\MessageLoggerModel;
use App\Entity\MessageLogger;

class MessageLoggerMapper implements MessageLoggerMapperInterface
{
    public function __construct(
    ) {
    }

    public function fromEntity(MessageLogger $entity): MessageLoggerModel
    {
        return new MessageLoggerModel(
            message: \App\Core\Domain\ValueObject\MessageLoggerMessage::create($entity->getMessage()),
            status: \App\Core\Domain\ValueObject\MessageLoggerStatus::create($entity->getStatus()),
            requestId: \App\Core\Domain\ValueObject\MessageLoggerRequestId::create($entity->requestId),
            id: \App\Core\Domain\ValueObject\MessageLoggerId::create($entity->getId()),
        );
    }

    public function toEntity(MessageLoggerModel $model): MessageLogger
    {
        return new MessageLogger(
            message: $model->message?->value(),
            status: $model->status?->value(),
            requestId: $model->requestId?->value(),
        );
    }

    public function fromArray(array $data): MessageLoggerModel
    {
        return new MessageLoggerModel(
            message: \App\Core\Domain\ValueObject\MessageLoggerMessage::create($data['message'] ?? null),
            status: \App\Core\Domain\ValueObject\MessageLoggerStatus::create($data['status'] ?? null),
            requestId: \App\Core\Domain\ValueObject\MessageLoggerRequestId::create($data['requestId'] ?? null),
            id: \App\Core\Domain\ValueObject\MessageLoggerId::create($data['id'] ?? null),
        );
    }

    public function toArray(MessageLoggerModel $model): array
    {
        return [
            'message' => $model->message?->valueView(),
            'status' => $model->status?->valueView(),
            'requestId' => $model->requestId?->valueView(),
            'id' => $model->id?->valueView(),
        ];
    }
}
