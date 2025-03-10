<?php

declare(strict_types=1);

namespace App\Core\Domain\Aggregate;

use App\Core\Domain\ValueObject\PromptId;
use App\Core\Domain\ValueObject\PromptPrompt;
use App\Core\Domain\ValueObject\PromptRequestId;
use App\Core\Domain\ValueObject\PromptUserId;
use App\Shared\Domain\Aggregate\AggregateRoot;

/**
 * Class Prompt* Aggregate Root of the Prompt context.
 */
class PromptModel extends AggregateRoot
{
    public function __construct(
        public ?PromptPrompt $prompt,
        public ?PromptUserId $userId,
        public ?PromptRequestId $requestId,
        public ?PromptId $id,
    ) {
    }

    public static function create(
        ?PromptPrompt $prompt,
        ?PromptUserId $userId,
        ?PromptRequestId $requestId,
        ?PromptId $id,
    ): self {
        return new self(
            $prompt,
            $userId,
            $requestId,
            $id,
        );
    }

    public function update(
        ?PromptPrompt $prompt,
        ?PromptUserId $userId,
        ?PromptRequestId $requestId,
        ?PromptId $id,
    ): self {
        return new self(
            $prompt,
            $userId,
            $requestId,
            $id,
        );
    }
}
