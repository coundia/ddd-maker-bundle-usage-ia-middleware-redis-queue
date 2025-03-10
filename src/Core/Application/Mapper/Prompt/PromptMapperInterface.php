<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\Prompt;

use App\Core\Domain\Aggregate\PromptModel;
use App\Entity\Prompt;

interface PromptMapperInterface
{
    public function fromEntity(Prompt $entity): PromptModel;

    public function toEntity(PromptModel $model): Prompt;

    public function fromArray(array $data): PromptModel;

    public function toArray(PromptModel $model): array;
}
