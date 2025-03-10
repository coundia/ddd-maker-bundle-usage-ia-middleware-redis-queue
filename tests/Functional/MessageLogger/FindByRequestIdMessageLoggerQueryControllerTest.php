<?php

declare(strict_types=1);

namespace App\Tests\Functional\MessageLogger;

use App\Core\Infrastructure\Factory\MessageLoggerFactory;
use App\Tests\Shared\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;

use function Zenstruck\Foundry\faker;

class FindByRequestIdMessageLoggerQueryControllerTest extends BaseWebTestCase
{
    use Factories;

    public function testListEntitiesWithPagination(): void
    {
        $entity = MessageLoggerFactory::createOne([
            'message' => $valueMessage = faker()->sentence(),
            'status' => $valueStatus = faker()->sentence(),
            'requestId' => $valueRequestId = faker()->sentence(),
        ])->_disableAutoRefresh();

        MessageLoggerFactory::createMany(9);

        $valueId = $entity->getId();

        $response = $this->get('/api/v1/messageloggers/findbyrequestid?requestId='.$valueRequestId);

        $response->assertStatusCode(Response::HTTP_OK);

        $content = $response->getData();

        $this->assertIsArray($content);
        $this->assertArrayHasKey('items', $content);

        $this->assertCount(1, $content['items']);

        $firstItem = $content['items'][0] ?? null;
        $this->assertNotNull($firstItem);

        $this->assertArrayHasKey('message', $firstItem);
        $this->assertEquals($entity->getMessage(), $firstItem['message']);

        $this->assertArrayHasKey('status', $firstItem);
        $this->assertEquals($entity->getStatus(), $firstItem['status']);

        $this->assertArrayHasKey('requestId', $firstItem);
        $this->assertEquals($entity->requestId, $firstItem['requestId']);

        $this->assertArrayHasKey('id', $firstItem);
        $this->assertEquals($entity->getId(), $firstItem['id']);
    }
}
