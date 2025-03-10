<?php

declare(strict_types=1);

namespace App\Shared\Domain\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ErrorResponseDTO.
 * Represents an error response.
 */
#[OA\Schema(
    title: 'Error Response DTO',
    description: 'Standard error response structure for API endpoints.',
    required: ['success', 'message', 'code']
)]
class ErrorResponseDTO
{
    public function __construct(
        #[Groups(['error'])]
        #[OA\Property(
            description: 'Indicates that the response is an error.',
            type: 'boolean',
            example: false
        )]
        public bool $success,

        #[Groups(['error'])]
        #[OA\Property(
            description: 'Error message providing additional details.',
            type: 'string',
            example: 'Validation errors occurred.'
        )]
        public string $message,

        #[Groups(['error'])]
        #[OA\Property(
            description: 'Error code representing the specific error.',
            type: 'integer',
            example: 1001
        )]
        public int $code,
    ) {
    }

    public static function fromError(bool $success, string $message, int $code): self
    {
        return new self($success, $message, $code);
    }
}
