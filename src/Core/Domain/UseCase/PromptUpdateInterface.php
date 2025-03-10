<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface PromptUpdateInterface* Defines the contract for updating Prompt entities.
 */
interface PromptUpdateInterface
{
    public function update(\App\Core\Domain\Aggregate\PromptModel $entity, \App\Core\Domain\ValueObject\PromptId $entityId): \App\Core\Domain\Aggregate\PromptModel;
}
