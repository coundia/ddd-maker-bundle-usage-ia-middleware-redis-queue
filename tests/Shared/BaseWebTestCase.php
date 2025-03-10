<?php

declare(strict_types=1);

namespace App\Tests\Shared;

/*
use App\Security\Domain\Entity\User;
use App\Security\Infrastructure\Factory\UserFactory;
*/
use App\Tests\Shared\Assertions\ResponseAssertions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

use function Zenstruck\Foundry\faker;

/**
 * BaseWebTestCase.
 * Provides a base test client for API testing with reusable HTTP methods and default authentication headers.
 */
abstract class BaseWebTestCase extends WebTestCase
{
    use Factories;
    use ResetDatabase;
    use ResponseAssertions;
    protected \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;
    protected ?Response $response = null;
    protected ?string $token = null;
    // protected ?User $user = null;
    public const API_VERSION = 'v1';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->response = null;
        $email = faker()->email();
        $password = 'password';
        /*
        $user = UserFactory::createOne([
        'email' => $email,
        'password' => $password,
        ]);

        $this->token = $this->login($email, $password);
        $this->user = $user;
        */
    }

    private function getDefaultHeaders(?array $headers = null): array
    {
        $default = [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_Authorization' => 'Bearer '.$this->token,
        ];

        return $headers ?: $default;
    }

    protected function get(string $uri, ?array $headers = null): static
    {
        $this->client->request('GET', $uri, [], [], $this->getDefaultHeaders($headers));
        $this->response = $this->client->getResponse();

        return $this;
    }

    protected function post(string $uri, array $data, ?array $headers = null): static
    {
        $this->client->request('POST', $uri, [], [], $this->getDefaultHeaders($headers), json_encode($data));
        $this->response = $this->client->getResponse();

        return $this;
    }

    protected function put(string $uri, array $data, ?array $headers = null): static
    {
        $this->client->request('PUT', $uri, [], [], $this->getDefaultHeaders($headers), json_encode($data));
        $this->response = $this->client->getResponse();

        return $this;
    }

    protected function delete(string $uri, ?array $headers = null): static
    {
        $this->client->request('DELETE', $uri, [], [], $this->getDefaultHeaders($headers));
        $this->response = $this->client->getResponse();

        return $this;
    }

    protected function getContent(): array
    {
        if (!$this->response) {
            throw new \RuntimeException('No response available.');
        }

        return json_decode($this->response->getContent(), true);
    }

    protected function login(string $email, string $password): string
    {
        $this->post('/api/v1/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $responseData = $this->getContent();

        if (empty($responseData['data']['token'])) {
            throw new \RuntimeException('Authentication token not found.');
        }

        return $responseData['data']['token'];
    }

    /*
    protected function user(): User
    {
    return $this->user;
    }
    */
}
