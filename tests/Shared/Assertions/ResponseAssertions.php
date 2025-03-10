<?php

declare(strict_types=1);

namespace App\Tests\Shared\Assertions;

trait ResponseAssertions
{
    protected function getContent(): array
    {
        if (!$this->response) {
            throw new \RuntimeException('No response available.');
        }

        return json_decode($this->response->getContent(), true);
    }

    protected function getData(): array
    {
        $content = $this->getContent();

        if (empty($content['data'])) {
            throw new \RuntimeException('No data found in response: '.print_r($content, true));
        }

        return $content['data'];
    }

    protected function getSuccess(): bool
    {
        $content = $this->getContent();

        return !empty($content['success']) ? (bool) $content['success'] : false;
    }

    protected function getMessage(): string
    {
        $content = $this->getContent();

        return $content['message'] ?? '';
    }

    protected function assertIsSuccess(): static
    {
        $this->assertTrue($this->getSuccess(), "Expected success, got error: {$this->getMessage()}");

        return $this;
    }

    protected function assertIsMessage(string $expectedMessage): static
    {
        $this->assertEquals($expectedMessage, $this->getMessage(), "Expected message {$expectedMessage}, got {$this->getMessage()}");

        return $this;
    }

    protected function assertIsError(): static
    {
        $this->assertFalse($this->getSuccess());

        return $this;
    }

    protected function assertStatusCode(int $expectedStatusCode): static
    {
        $this->assertEquals(
            $expectedStatusCode,
            $this->response->getStatusCode(),
            "Expected status code {$expectedStatusCode}, got {$this->response->getStatusCode()}.\n".$this->response->getContent()
        );

        return $this;
    }

    protected function debug(): static
    {
        print_r($this->getContent());

        return $this;
    }
}
