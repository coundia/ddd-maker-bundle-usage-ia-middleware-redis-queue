<?php

declare(strict_types=1);

namespace App\Tests\Functional\Prompt;

use App\Tests\Shared\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

use function Zenstruck\Foundry\faker;

class CreatePromptCommandControllerTest extends BaseWebTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testCreateEntity(): void
    {
        $payload = [
            'prompt' => faker()->sentence(),
            'userId' => faker()->sentence(),
            'requestId' => faker()->sentence(),
        ];

        $response = $this->post('/api/v1/prompts/create/', $payload);
        $response->assertResponseStatusCodeSame(Response::HTTP_CREATED);

        $response->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $content = $response->getData();

        $this->assertArrayHasKey('id', $content);
        $this->assertNotNull($content['id']);

        $this->assertEquals($payload['prompt'], $content['prompt']);

        $this->assertEquals($payload['userId'], $content['userId']);

        $this->assertEquals($payload['requestId'], $content['requestId']);
    }
}
