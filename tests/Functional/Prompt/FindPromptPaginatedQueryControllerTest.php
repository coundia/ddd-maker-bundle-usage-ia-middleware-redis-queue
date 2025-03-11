<?php

declare(strict_types=1);

namespace App\Tests\Functional\Prompt;

use App\Core\Infrastructure\Factory\PromptFactory;
use App\Tests\Shared\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;

use function Zenstruck\Foundry\faker;

class FindPromptPaginatedQueryControllerTest extends BaseWebTestCase
{
    use Factories;

    public function testListEntitiesWithPagination(): void
    {
        $entity = PromptFactory::createOne([
            'prompt' => $valuePrompt = faker()->sentence(),
            'userId' => $valueUserId = faker()->sentence(),
            'requestId' => $valueRequestId = faker()->sentence(),
        ])->_disableAutoRefresh();

        PromptFactory::createMany(100);

        $response = $this->get('/api/v1/prompts/list');
        $response->assertStatusCode(Response::HTTP_OK);
        $content = $response->getData();
        $this->assertIsArray($content);
        $this->assertArrayHasKey('items', $content);
        $this->assertArrayHasKey('total', $content);

        $this->assertCount(10, $content['items']);
        $this->assertEquals(10, $content['total']);

        $firstItem = $content['items'][0] ?? null;
        $this->assertNotNull($firstItem);

        $this->assertArrayHasKey('prompt', $firstItem);
        $this->assertEquals($entity->getPrompt(), $firstItem['prompt']);

        $this->assertArrayHasKey('userId', $firstItem);
        $this->assertEquals($entity->getUserId(), $firstItem['userId']);

        $this->assertArrayHasKey('requestId', $firstItem);
        $this->assertEquals($entity->getRequestId(), $firstItem['requestId']);

        $this->assertArrayHasKey('id', $firstItem);
        $this->assertEquals($entity->getId(), $firstItem['id']);
    }
}
