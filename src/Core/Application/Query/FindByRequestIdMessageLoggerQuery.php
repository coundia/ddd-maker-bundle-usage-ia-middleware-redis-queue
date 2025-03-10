<?php

namespace App\Core\Application\Query;

class FindByRequestIdMessageLoggerQuery
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\MessageLoggerRequestId $requestId,
    ) {
    }
}
