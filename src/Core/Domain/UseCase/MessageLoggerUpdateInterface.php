<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCase;

/**
 * Interface MessageLoggerUpdateInterface* Defines the contract for updating MessageLogger entities.
 */
interface MessageLoggerUpdateInterface
{
    public function update(\App\Core\Domain\Aggregate\MessageLoggerModel $entity, \App\Core\Domain\ValueObject\MessageLoggerId $entityId): \App\Core\Domain\Aggregate\MessageLoggerModel;
}
