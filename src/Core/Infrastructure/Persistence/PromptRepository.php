<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Aggregate\PromptModel;
use App\Core\Domain\Repository\PromptRepositoryInterface;
use App\Core\Domain\ValueObject\PromptId;
use App\Entity\Prompt;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

class PromptRepository implements PromptRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private \App\Core\Application\Mapper\Prompt\PromptMapperInterface $mapper
    ) {
    }

    public function save(PromptModel $prompt): PromptModel
    {
        $entity = new Prompt(
            prompt: $prompt->prompt?->value(),
            userId: $prompt->userId?->value(),
            requestId: $prompt->requestId?->value(),
        );

        if (!$this->em->contains($entity)) {
            $this->em->persist($entity);
        }

        $this->em->flush();

        return $this->mapper->fromEntity($entity);
    }

    public function update(PromptModel $prompt, PromptId $id): PromptModel
    {
        $entity = $this->em->find(Prompt::class, $id?->value());

        if ($entity) {
            $entity->setPrompt($prompt->prompt?->value());
            $entity->setUserId($prompt->userId?->value());
            $entity->setRequestId($prompt->requestId?->value());
            $this->em->flush();
        }

        return $this->mapper->fromEntity($entity);
    }

    public function find(PromptId $id): ?PromptModel
    {
        $entity = $this->em->find(Prompt::class, $id?->value());

        return $entity ? $this->mapper->fromEntity($entity) : null;
    }

    public function delete(PromptId $id): PromptId
    {
        $entity = $this->em->find(Prompt::class, $id?->value());

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }

        return $id;
    }

    public function findById(PromptId $id): ?PromptModel
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(Prompt::class, 'e')
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
     * @return array<\App\Core\Domain\Aggregate\PromptModel>|null
     */
    public function findAll(): array
    {
        return array_map(
            fn ($entity) => $this->mapper->fromEntity($entity),
            $this->em->createQueryBuilder()
            ->select('e')
            ->from(Prompt::class, 'e')
            ->getQuery()
            ->getResult()
        );
    }

    /**
     * @return array<\App\Core\Domain\Aggregate\PromptModel>|null
     */
    public function findByCriteria(array $criteria): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(Prompt::class, 'e');

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
     *     items: array<\App\Core\Domain\Aggregate\PromptModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array
    {
        $qb = $this->em->createQueryBuilder()
        ->select('e')
        ->from(Prompt::class, 'e');

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
