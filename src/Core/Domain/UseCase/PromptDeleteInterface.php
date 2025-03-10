<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface PromptDeleteInterface* Defines the contract for deleting a Prompt.
 */
interface PromptDeleteInterface
{
    public function delete(\App\Core\Domain\ValueObject\PromptId $id): \App\Core\Domain\ValueObject\PromptId;
}
