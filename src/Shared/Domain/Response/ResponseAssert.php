<?php

declare(strict_types=1);

namespace App\Shared\Domain\Response;

/**
 * ResponseAssert.
 * Provides assertion methods for validating API responses.
 */
class ResponseAssert
{
    public static function assertSuccess(array $response): void
    {
        if (!$response['success']) {
            throw new \Exception('Response is not successful');
        }
    }
}
