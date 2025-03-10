<?php

declare(strict_types=1);

namespace App\Core\Domain\Aggregate;

use App\Core\Domain\ValueObject\FileFilename;
use App\Core\Domain\ValueObject\FileFilePath;
use App\Core\Domain\ValueObject\FileId;
use App\Shared\Domain\Aggregate\AggregateRoot;

/**
 * Class File* Aggregate Root of the File context.
 */
class FileModel extends AggregateRoot
{
    public function __construct(
        public ?FileFilename $filename,
        public ?FileFilePath $filePath,
        public ?FileId $id,
    ) {
    }

    public static function create(
        ?FileFilename $filename,
        ?FileFilePath $filePath,
        ?FileId $id,
    ): self {
        return new self(
            $filename,
            $filePath,
            $id,
        );
    }

    public function update(
        ?FileFilename $filename,
        ?FileFilePath $filePath,
        ?FileId $id,
    ): self {
        return new self(
            $filename,
            $filePath,
            $id,
        );
    }
}
