<?php

declare(strict_types=1);

namespace App\Core\Application\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class MessageLoggerDTO* abstract Transfer Object for MessageLogger.
 */
abstract class MessageLoggerDTO
{
    public function __construct(
        #[Groups(['default'])]
        public ?string $message,
        #[Groups(['default'])]
        public ?string $status,
        #[Groups(['default'])]
        public ?string $requestId,
        #[Groups(['default'])]
        public ?string $id,
    ) {
    }
}
