<?php

declare(strict_types=1);

namespace App\Shared\Domain\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

#[OA\Schema(
    title: 'API Response DTO',
    description: 'Standard response structure for API endpoints.'
)]
class ApiResponseDTO
{
    #[Groups(['default', 'error'])]
    #[OA\Property(
        description: 'Indicates whether the operation was successful.',
        type: 'boolean',
        example: true
    )]
    public bool $success;

    /**
     * @var mixed|null The response data, which can be of any type (array, object, string, etc.).
     */
    #[Groups(['default'])]
    #[OA\Property(
        property: 'data',
        description: 'The response data.',
        type: 'object',
        nullable: true
    )]
    public mixed $data;

    #[Groups(['default', 'error'])]
    #[OA\Property(
        description: 'Additional message regarding the response.',
        type: 'string',
        example: 'Success.',
        nullable: true
    )]
    public ?string $message;

    public function __construct(bool $success, mixed $data = null, ?string $message = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * Creates a success response.
     */
    public static function success(mixed $data = null, ?string $message = 'Success'): self
    {
        return new self(true, $data, $message);
    }

    /**
     * Creates an error response.
     */
    public static function error(?string $message = 'Error', mixed $data = null): self
    {
        return new self(false, $data, $message);
    }
}
