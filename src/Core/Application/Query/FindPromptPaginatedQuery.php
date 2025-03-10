<?php

declare(strict_types=1);

namespace App\Core\Application\Query;

/**
 * Class FindPromptPaginatedQuery* Query for fetching paginated Prompt records with optional filters.
 */
class FindPromptPaginatedQuery
{
    public function __construct(
        public int $page = 1,
        public int $limit = 10,
        public array $filters = []
    ) {
    }
}
