<?php

namespace App\Core\Application\QueryHandler;

use App\Core\Application\Query\FindByRequestIdMessageLoggerQuery;
use App\Entity\MessageLogger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindByRequestIdMessageLoggerQueryHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private \App\Core\Application\Mapper\MessageLogger\MessageLoggerMapper $mapper
    ) {
    }

    public function __invoke(FindByRequestIdMessageLoggerQuery $query): array
    {
        $parameter = $query->requestId?->value();
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('e')
        ->from(MessageLogger::class, 'e')
        ->where('e.requestId = :parameter')
        ->setParameter('parameter', $parameter);

        $result = $qb->getQuery()->getResult();

        if (!$result) {
            throw new \Exception('Not found');
        }

        $data = array_map(
            fn ($entity) => $this->mapper->toArray($this->mapper->fromEntity($entity)),
            $result
        );

        return $data;
    }
}
