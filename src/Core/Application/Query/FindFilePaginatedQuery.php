<?php

declare(strict_types=1);

namespace App\Core\Application\Query;

/**
 * Class FindFilePaginatedQuery* Query for fetching paginated File records with optional filters.
 */
class FindFilePaginatedQuery
{
    public function __construct(
        public int $page = 1,
        public int $limit = 10,
        public array $filters = []
    ) {
    }
}
