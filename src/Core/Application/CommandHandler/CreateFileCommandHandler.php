<?php
/**
 * Class CreateFileCommandHandler*.
 *
 * @see \App\Core\Application\Command\CreateFileCommand*
 */
declare(strict_types=1);

namespace App\Core\Application\CommandHandler;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateFileCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private \App\Core\Application\Mapper\File\FileMapper $mapper
    ) {
    }

    public function __invoke(\App\Core\Application\Command\CreateFileCommand $command): \App\Core\Domain\Aggregate\FileModel
    {
        $entity = new File(
            filename: $command->filename?->value(),
            filePath: $command->filePath?->value(),
        );

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->mapper->fromEntity($entity);
    }
}
