<?php

declare(strict_types=1);

namespace App\Core\Application\Mapper\File;

use App\Core\Domain\Aggregate\FileModel;
use App\Entity\File;

class FileMapper implements FileMapperInterface
{
    public function __construct(
    ) {
    }

    public function fromEntity(File $entity): FileModel
    {
        return new FileModel(
            filename: \App\Core\Domain\ValueObject\FileFilename::create($entity->getFilename()),
            filePath: \App\Core\Domain\ValueObject\FileFilePath::create($entity->getFilePath()),
            id: \App\Core\Domain\ValueObject\FileId::create($entity->getId()),
        );
    }

    public function toEntity(FileModel $model): File
    {
        return new File(
            filename: $model->filename?->value(),
            filePath: $model->filePath?->value(),
        );
    }

    public function fromArray(array $data): FileModel
    {
        return new FileModel(
            filename: \App\Core\Domain\ValueObject\FileFilename::create($data['filename'] ?? null),
            filePath: \App\Core\Domain\ValueObject\FileFilePath::create($data['filePath'] ?? null),
            id: \App\Core\Domain\ValueObject\FileId::create($data['id'] ?? null),
        );
    }

    public function toArray(FileModel $model): array
    {
        return [
            'filename' => $model->filename?->valueView(),
            'filePath' => $model->filePath?->valueView(),
            'id' => $model->id?->valueView(),
        ];
    }
}
