<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\Prompt;

use App\Core\Domain\Aggregate\PromptModel;
use App\Entity\Prompt;

class PromptMapper implements PromptMapperInterface
{
    public function __construct(
    ) {
    }

    public function fromEntity(Prompt $entity): PromptModel
    {
        return new PromptModel(
            prompt: \App\Core\Domain\ValueObject\PromptPrompt::create($entity->getPrompt()),
            userId: \App\Core\Domain\ValueObject\PromptUserId::create($entity->getUserId()),
            requestId: \App\Core\Domain\ValueObject\PromptRequestId::create($entity->getRequestId()),
            id: \App\Core\Domain\ValueObject\PromptId::create($entity->getId()),
        );
    }

    public function toEntity(PromptModel $model): Prompt
    {
        return new Prompt(
            prompt: $model->prompt?->value(),
            userId: $model->userId?->value(),
            requestId: $model->requestId?->value(),
        );
    }

    public function fromArray(array $data): PromptModel
    {
        return new PromptModel(
            prompt: \App\Core\Domain\ValueObject\PromptPrompt::create($data['prompt'] ?? ""),
            userId: \App\Core\Domain\ValueObject\PromptUserId::create($data['userId'] ?? ""),
            requestId: \App\Core\Domain\ValueObject\PromptRequestId::create($data['requestId'] ?? ""),
            id: \App\Core\Domain\ValueObject\PromptId::create($data['id'] ?? ""),
        );
    }

    public function toArray(PromptModel $model): array
    {
        return [
            'prompt' => $model->prompt?->valueView(),
            'userId' => $model->userId?->valueView(),
            'requestId' => $model->requestId?->valueView(),
            'id' => $model->id?->valueView(),
        ];
    }
}
