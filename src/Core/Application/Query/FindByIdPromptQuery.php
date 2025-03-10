<?php

namespace App\Core\Application\Query;

class FindByIdPromptQuery
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\PromptId $id,
    ) {
    }
}
