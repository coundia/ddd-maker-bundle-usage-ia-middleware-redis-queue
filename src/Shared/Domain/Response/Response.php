<?php

declare(strict_types=1);

namespace App\Shared\Domain\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Response.
 * Provides static methods to generate API responses.
 */
class Response extends JsonResponse
{
    public static function successResponse(mixed $data, int $status = ResponseAlias::HTTP_OK, string $message = 'Success'): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public static function errorResponse(string $message = 'Error', int $code = 0, ?array $details = null, int $status = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'code' => $code,
        ];

        if ($details) {
            $response['errors'] = $details;
        }

        return new JsonResponse($response, $status);
    }
}
