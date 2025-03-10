<?php

declare(strict_types=1);

namespace App\Core\Presentation\Controller;

use App\Core\Application\DTO\PromptRequestDTO;
use App\Core\Domain\ValueObject\PromptRequestId;
use App\Shared\Application\Bus\MessageBus;
use App\Shared\Domain\DTO\ApiResponseDTO;
use App\Shared\Domain\DTO\ErrorResponseDTO;
use App\Shared\Domain\Response\Response;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/prompts/create/', name: 'api_command_v1_prompt_create', methods: ['POST'])]
#[OA\Post(
    path: '/api/v1/prompts/create/',
    summary: 'Creates a new Prompt item.',
    requestBody: new OA\RequestBody(
        description: 'Data required to create a Prompt.',
        required: true,
        content: new Model(type: PromptRequestDTO::class, groups: ['default'])
    ),
    tags: ['Prompts'],
    responses: [
        new OA\Response(
            response: 201,
            description: 'Prompt created successfully.',
            content: new Model(type: ApiResponseDTO::class, groups: ['default'])
        ),
        new OA\Response(
            response: 400,
            description: 'Invalid input.',
            content: new Model(type: ErrorResponseDTO::class, groups: ['error'])
        ),
    ]
)]
class CreatePromptController extends \App\Shared\Presentation\Controller\BaseController
{
    public function __construct(
        private \App\Shared\Application\Bus\MessageBus $command_bus,
        private \App\Core\Application\Mapper\Prompt\PromptMapperInterface $mapper
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
			$requestId = Uuid::uuid4()->toString();
            $command_model = $this->mapper->fromArray($data);
            $command = new \App\Core\Application\Command\CreatePromptCommand(
                prompt: $command_model->prompt,
                userId: $command_model->userId ,
                requestId: PromptRequestId::create($requestId),
            );
              $this->command_bus->dispatch($command);

            return Response::successResponse("Pending with requestId: ".$requestId, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return Response::errorResponse($e->getMessage());
        }
    }
}
