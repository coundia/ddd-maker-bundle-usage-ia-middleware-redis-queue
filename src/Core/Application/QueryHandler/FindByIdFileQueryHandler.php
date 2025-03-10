<?php

namespace App\Core\Application\QueryHandler;

use App\Core\Application\Query\FindByIdFileQuery;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindByIdFileQueryHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private \App\Core\Application\Mapper\File\FileMapper $mapper
    ) {
    }

    public function __invoke(FindByIdFileQuery $query): array
    {
        $parameter = $query->id?->value();
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('e')
        ->from(File::class, 'e')
        ->where('e.id = :parameter')
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
