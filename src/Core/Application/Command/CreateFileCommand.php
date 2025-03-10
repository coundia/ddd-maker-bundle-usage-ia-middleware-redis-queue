<?php

declare(strict_types=1);

namespace App\Core\Application\Command;

/**
 * Class CreateFileCommand Represents a command for creating a File.
 */
class CreateFileCommand
{
    public function __construct(
        public ?\App\Core\Domain\ValueObject\FileFilename $filename,
        public ?\App\Core\Domain\ValueObject\FileFilePath $filePath,
    ) {
    }
}
