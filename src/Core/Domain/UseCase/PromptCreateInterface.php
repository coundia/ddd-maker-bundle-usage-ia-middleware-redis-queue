<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface PromptCreateInterface* Defines the contract for creating a Prompt.
 */
interface PromptCreateInterface
{
    public function create(\App\Core\Domain\Aggregate\PromptModel $prompt): \App\Core\Domain\Aggregate\PromptModel;
}
