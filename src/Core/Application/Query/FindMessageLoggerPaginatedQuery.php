<?php

declare(strict_types=1);

namespace App\Core\Application\Query;

/**
 * Class FindMessageLoggerPaginatedQuery* Query for fetching paginated MessageLogger records with optional filters.
 */
class FindMessageLoggerPaginatedQuery
{
    public function __construct(
        public int $page = 1,
        public int $limit = 10,
        public array $filters = []
    ) {
    }
}
