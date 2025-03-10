<?php

namespace App\Core\Application\Query;

class FindByIdMessageLoggerQuery
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\MessageLoggerId $id,
    ) {
    }
}
