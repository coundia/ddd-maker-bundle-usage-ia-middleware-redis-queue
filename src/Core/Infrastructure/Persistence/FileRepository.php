<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Persistence;

use App\Core\Domain\Aggregate\FileModel;
use App\Core\Domain\Repository\FileRepositoryInterface;
use App\Core\Domain\ValueObject\FileId;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

class FileRepository implements FileRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private \App\Core\Application\Mapper\File\FileMapperInterface $mapper
    ) {
    }

    public function save(FileModel $file): FileModel
    {
        $entity = new File(
            filename: $file->filename?->value(),
            filePath: $file->filePath?->value(),
        );

        if (!$this->em->contains($entity)) {
            $this->em->persist($entity);
        }

        $this->em->flush();

        return $this->mapper->fromEntity($entity);
    }

    public function update(FileModel $file, FileId $id): FileModel
    {
        $entity = $this->em->find(File::class, $id?->value());

        if ($entity) {
            $entity->setFilename($file->filename?->value());
            $entity->setFilePath($file->filePath?->value());
            $this->em->flush();
        }

        return $this->mapper->fromEntity($entity);
    }

    public function find(FileId $id): ?FileModel
    {
        $entity = $this->em->find(File::class, $id?->value());

        return $entity ? $this->mapper->fromEntity($entity) : null;
    }

    public function delete(FileId $id): FileId
    {
        $entity = $this->em->find(File::class, $id?->value());

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }

        return $id;
    }

    public function findById(FileId $id): ?FileModel
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(File::class, 'e')
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
     * @return array<\App\Core\Domain\Aggregate\FileModel>|null
     */
    public function findAll(): array
    {
        return array_map(
            fn ($entity) => $this->mapper->fromEntity($entity),
            $this->em->createQueryBuilder()
            ->select('e')
            ->from(File::class, 'e')
            ->getQuery()
            ->getResult()
        );
    }

    /**
     * @return array<\App\Core\Domain\Aggregate\FileModel>|null
     */
    public function findByCriteria(array $criteria): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('e')
        ->from(File::class, 'e');

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
     *     items: array<\App\Core\Domain\Aggregate\FileModel>,
     *     total: int,
     *     page: int,
     *     limit: int
     * }
     */
    public function findPaginated(int $page, int $limit, array $criteria = []): array
    {
        $qb = $this->em->createQueryBuilder()
        ->select('e')
        ->from(File::class, 'e');

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
