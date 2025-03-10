<?php

namespace App\Core\Application\Query;

class FindByIdFileQuery
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\FileId $id,
    ) {
    }
}
