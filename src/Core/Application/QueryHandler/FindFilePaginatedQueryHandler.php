<?php

declare(strict_types=1);

namespace App\Core\Application\QueryHandler;

use App\Core\Application\Query\FindFilePaginatedQuery;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindFilePaginatedQueryHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private \App\Core\Application\Mapper\File\FileMapper $mapper
    ) {
    }

    public function __invoke(FindFilePaginatedQuery $query): array
    {
        $page = $query->page;
        $limit = $query->limit;
        $offset = ($page - 1) * $limit;

        // Build the query to fetch paginated data with filters applied
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('e')
        ->from(File::class, 'e')
        ->setFirstResult($offset)
        ->setMaxResults($limit);

        if (!empty($query->filters) && is_array($query->filters)) {
            foreach ($query->filters as $field => $value) {
                if (null !== $value && '' !== $value) {
                    if (is_string($value) && str_contains($value, '%')) {
                        $qb->andWhere("e.$field LIKE :$field")
                        ->setParameter($field, $value);
                    } else {
                        $qb->andWhere("e.$field = :$field")
                        ->setParameter($field, $value);
                    }
                }
            }
        }

        $result = $qb->getQuery()->getResult();

        // Build a count query with the same filters to determine total records
        $countQb = $this->entityManager->createQueryBuilder();
        $countQb->select('COUNT(e.id)')
        ->from(File::class, 'e');

        if (!empty($query->filters) && is_array($query->filters)) {
            foreach ($query->filters as $field => $value) {
                if (null !== $value && '' !== $value) {
                    if (is_string($value) && str_contains($value, '%')) {
                        $countQb->andWhere("e.$field LIKE :$field")
                        ->setParameter($field, $value);
                    } else {
                        $countQb->andWhere("e.$field = :$field")
                        ->setParameter($field, $value);
                    }
                }
            }
        }
        $total = (int) $countQb->getQuery()->getSingleScalarResult();

        $data = array_map(
            fn ($entity) => $this->mapper->toArray($this->mapper->fromEntity($entity)),
            $result
        );

        return [
            'data' => $data,
            'total' => $total,
        ];
    }
}
