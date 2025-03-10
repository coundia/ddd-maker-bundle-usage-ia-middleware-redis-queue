<?php

declare(strict_types=1);

namespace App\Core\Application\CommandHandler;

use App\Core\Application\Command\CreatePromptCommand;
use App\Core\Application\Mapper\Prompt\PromptMapper;
use App\Core\Domain\Aggregate\PromptModel;
use App\Core\Domain\UseCase\ApiProvider;
use App\Entity\MessageLogger;
use App\Entity\Prompt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
readonly class CreatePromptCommandHandler
{
	public function __construct(
		private EntityManagerInterface $entityManager,
		private ApiProvider $apiProvider,
		private PromptMapper $mapper
	) {
	}

	public function __invoke(CreatePromptCommand $command):
	PromptModel
	{
		$entity = new Prompt(
			prompt: $command->prompt?->value(),
			userId: $command->userId?->value(),
			requestId: $command->requestId?->value(),
		);

		$prompt = $command->prompt?->value();
		$response = $this->apiProvider->callApi($prompt);

		$entity->setStatus('processed');
		$this->entityManager->persist($entity);
		$this->entityManager->flush();

		$messageLog = $this->entityManager->createQueryBuilder()
			->select('m')
			->from(MessageLogger::class, 'm')
			->where('m.requestId = :requestId')
			->setParameter('requestId', $command->requestId?->value())
			->getQuery()
			->getOneOrNullResult();

		if ($messageLog) {
			$messageLog->setMessage($response);
			$messageLog->setStatus('processed');
			$this->entityManager->flush();
		}

		return $this->mapper->fromEntity($entity);
	}

}
