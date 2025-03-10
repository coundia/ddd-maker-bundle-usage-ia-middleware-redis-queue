<?php

declare(strict_types=1);

namespace App\Shared\Domain\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ValidationErrorResponseDTO.
 * Represents a validation error response.
 */
#[OA\Schema(
    title: 'Validation Error Response DTO',
    description: 'Standard error response structure for validation errors.',
    required: ['success', 'message', 'errors']
)]
class ValidationErrorResponseDTO
{
    public function __construct(
        #[Groups(['error'])]
        #[OA\Property(
            description: 'Indicates the operation was not successful.',
            type: 'boolean',
            example: false
        )]
        public bool $success,

        #[Groups(['error'])]
        #[OA\Property(
            description: 'Error message detailing the validation issues.',
            type: 'string',
            example: 'Validation errors.'
        )]
        public string $message,

        #[Groups(['error'])]
        #[OA\Property(
            description: 'List of validation errors with field-specific messages.',
            type: 'object',
            example: ['email' => 'This value should not be blank.', 'password' => 'This value should not be blank.']
        )]
        public array $errors,
    ) {
    }

    public static function fromErrors(bool $success, string $message, array $errors): self
    {
        return new self($success, $message, $errors);
    }
}
