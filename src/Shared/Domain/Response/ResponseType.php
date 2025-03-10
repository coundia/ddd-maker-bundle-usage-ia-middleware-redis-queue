<?php

declare(strict_types=1);

namespace App\Shared\Domain\Response;

use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ResponseType.
 * Provides methods to inspect and assert a JsonResponse.
 */
final class ResponseType
{
    private JsonResponse $_response;

    public function __construct(JsonResponse $response)
    {
        $this->_response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->_response->getStatusCode();
    }

    public function getContent(bool $throw = false): string
    {
        return $this->_response->getContent($throw);
    }

    public function toArray(bool $throw = false): array
    {
        return json_decode($this->_response->getContent($throw), true);
    }

    public function getData(?string $param = null): mixed
    {
        $responseData = $this->toArray();
        $data = $responseData['data'] ?? null;

        if (!$data) {
            print_r('Error: ');
            print_r($responseData);
        }

        if ($param && is_array($data)) {
            $data = $data[$param] ?? $data;
        }

        return $data;
    }

    public function assertResponse(bool $isOk = true): self
    {
        $success = $this->getStatusCode() >= 200 && $this->getStatusCode() < 300;
        Assert::assertEquals(
            $isOk,
            $success,
            sprintf('Failed asserting that the response is %s. Got status code %d.', $isOk ? 'successful' : 'not successful', $this->getStatusCode())
        );

        return $this;
    }

    public function assertResponseStatusCodeSame(int $expectedStatusCode): self
    {
        Assert::assertSame(
            $expectedStatusCode,
            $this->getStatusCode(),
            sprintf('Failed asserting that the response status code is %d.', $expectedStatusCode)
        );

        return $this;
    }

    public function assertResponseIsSuccessful(bool $isOk = true): self
    {
        $this->assertResponse($isOk);
        $successKey = $this->toArray()['success'] ?? null;
        Assert::assertEquals(
            $isOk,
            $successKey,
            sprintf('Failed asserting that the response is %s. Got success key %s.', $isOk ? 'successful' : 'not successful', $successKey)
        );

        return $this;
    }

    public function assertMessage(string $message): self
    {
        $messageOk = $this->toArray()['message'] ?? null;
        Assert::assertEquals(
            $message,
            $messageOk,
            sprintf('Failed asserting that the response message is %s. Got message %s.', $message, $messageOk)
        );

        return $this;
    }

    public function assertIsErrors(): void
    {
        $this->assertResponseIsSuccessful(false);
    }

    public function assertResponseData(array $dataAttributes): self
    {
        $this->assertResponseIsSuccessful();
        $responseData = $this->toArray();
        $data = $responseData['data'] ?? null;

        foreach ($dataAttributes as $key => $value) {
            Assert::assertArrayHasKey($key, $data);
            Assert::assertEquals($value, $data[$key]);
        }

        return $this;
    }

    public function assertResponseErrors(int $statusCode, int $statusInternCode, array $dataErrorAttributes): self
    {
        $this->assertResponse(false);
        $responseData = $this->toArray();
        $errorsData = $responseData['errors'] ?? null;
        $statusCodeIntern = $responseData['code'] ?? null;
        $this->assertResponseStatusCodeSame($statusCode);
        Assert::assertEquals($statusInternCode, $statusCodeIntern, sprintf('Failed asserting that the response status code is %d.', $statusInternCode));

        foreach ($dataErrorAttributes as $key => $value) {
            Assert::assertArrayHasKey($key, $errorsData);
            Assert::assertEquals($value, $errorsData[$key]);
        }

        return $this;
    }

    public function debug(): self
    {
        var_dump($this->toArray());

        return $this;
    }

    public static function create(JsonResponse $response): self
    {
        return new self($response);
    }
}
