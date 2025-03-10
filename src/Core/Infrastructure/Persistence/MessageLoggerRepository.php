<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Aggregate\MessageLoggerModel;
use App\Core\Domain\Repository\MessageLoggerRepositoryInterface;
use App\Core\Domain\ValueObject\MessageLoggerId;
use App\Entity\MessageLogger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

class MessageLoggerRepository implements MessageLoggerRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private \App\Core\Application\Mapper\MessageLogger\MessageLoggerMapperInterface $mapper
    ) {
    }

    public function save(MessageLoggerModel $messagelogger): MessageLoggerModel
    {
        $entity = new MessageLogger(
            message: $messagelogger->message?->value(),
            status: $messagelogger->status?->value(),
            requestId: $messagelogger->requestId?->value(),
        );

        if (!$this->em->contains($entity)) {
            $this->em->persist($entity);
        }

        $this->em->flush();

        return $this->mapper->fromEntity($entity);
    }

    public function update(MessageLoggerModel $messagelogger, MessageLoggerId $id): MessageLoggerModel
    {
        $entity = $this->em->find(MessageLogger::class, $id?->value());

        if ($entity) {
            $entity->setMessage($messagelogger->message?->value());
            $entity->setStatus($messagelogger->status?->value());
            $this->em->flush();
        }

        return $this->mapper->fromEntity($entity);
    }

    public function find(MessageLoggerId $id): ?MessageLoggerModel
    {
        $entity = $this->em->find(MessageLogger::class, $id?->value());

        return $entity ? $this->mapper->fromEntity($entity) : null;
    }

    public function delete(MessageLoggerId $id): MessageLoggerId
    {
        $entity = $this->em->find(MessageLogger::class, $id?->value());

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }

        return $id;
    }

    public function findById(MessageLoggerId $id): ?MessageLoggerModel
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(MessageLogger::class, 'e')
        ->where('e.id = :id')
        ->setParameter('id', $id?->value());

        try {
            $entity = $qb->getQuery()->getSingleResult();

            return $this->mapper->fromEntity($entity);
        } catch (NoResultException) {
            return null;
        }
    }

    /**
     * @return array<\App\Core\Domain\Aggregate\MessageLoggerModel>|null
     */
    public function findAll(): array
    {
        return array_map(
            fn ($entity) => $this->mapper->fromEntity($entity),
            $this->em->createQueryBuilder()
            ->select('e')
            ->from(MessageLogger::class, 'e')
            ->getQuery()
            ->getResult()
        );
    }

    /**
     * @return array<\App\Core\Domain\Aggregate\MessageLoggerModel>|null
     */
    public function findByCriteria(array $criteria): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(MessageLogger::class, 'e');

        foreach ($criteria as $field => $value) {
            $qb->andWhere("e.$field = :$field")
            ->setParameter($field, $value);
        }

        return array_map(
            fn ($entity) => $this->mapper->fromEntity($entity),
            $qb->getQuery()->getResult()
        );
    }

    /**
     * @return array{
     *     items: array<\App\Core\Domain\Aggregate\MessageLoggerModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array
    {
        $qb = $this->em->createQueryBuilder()
        ->select('e')
        ->from(MessageLogger::class, 'e');

        foreach ($criteria as $field => $value) {
            $qb->andWhere("e.$field = :$field")
            ->setParameter($field, $value);
        }

        $total = (clone $qb)
        ->select('COUNT(e.id)')
        ->getQuery()
        ->getSingleScalarResult();

        $items = $qb->setFirstResult(($page - 1) * $limit)
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();

        return [
            'items' => array_map(
                fn ($entity) => $this->mapper->toArray($this->mapper->fromEntity($entity)),
                $items
            ),
            'total' => (int) $total,
            'page' => $page,
            'limit' => $limit,
        ];
    }
}
