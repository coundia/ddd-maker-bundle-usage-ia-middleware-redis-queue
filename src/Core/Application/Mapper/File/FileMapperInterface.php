<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\File;

use App\Core\Domain\Aggregate\FileModel;
use App\Entity\File;

interface FileMapperInterface
{
    public function fromEntity(File $entity): FileModel;

    public function toEntity(FileModel $model): File;

    public function fromArray(array $data): FileModel;

    public function toArray(FileModel $model): array;
}
