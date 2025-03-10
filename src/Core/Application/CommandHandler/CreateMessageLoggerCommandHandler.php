<?php
/**
 * Class CreateMessageLoggerCommandHandler*.
 *
 * @see \App\Core\Application\Command\CreateMessageLoggerCommand*
 */
declare(strict_types=1);

namespace App\Core\Application\CommandHandler;

use App\Entity\MessageLogger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateMessageLoggerCommandHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private \App\Core\Application\Mapper\MessageLogger\MessageLoggerMapper $mapper
    ) {
    }

    public function __invoke(\App\Core\Application\Command\CreateMessageLoggerCommand $command): \App\Core\Domain\Aggregate\MessageLoggerModel
    {
        $entity = new MessageLogger(
            message: $command->message?->value(),
            status: $command->status?->value(),
            requestId: $command->requestId?->value(),
        );

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->mapper->fromEntity($entity);
    }
}
