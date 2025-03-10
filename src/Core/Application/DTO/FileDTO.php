<?php

declare(strict_types=1);

namespace App\Core\Application\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class FileDTO* abstract Transfer Object for File.
 */
abstract class FileDTO
{
    public function __construct(
        #[Groups(['default'])]
        public ?string $filename,
        #[Groups(['default'])]
        public ?string $filePath,
        #[Groups(['default'])]
        public ?string $id,
    ) {
    }
}
