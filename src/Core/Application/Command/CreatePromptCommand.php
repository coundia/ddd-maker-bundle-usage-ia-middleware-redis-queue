<?php

declare(strict_types=1);

namespace App\Core\Application\Command;

/**
 * Class CreatePromptCommand Represents a command for creating a Prompt.
 */
class CreatePromptCommand extends \App\Shared\Infrastructure\Bus\MessageAsync{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\PromptPrompt $prompt,
        public ?\App\Core\Domain\ValueObject\PromptUserId $userId,
        public ?\App\Core\Domain\ValueObject\PromptRequestId $requestId,
    ) {
    }
}
