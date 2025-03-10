<?php

namespace App\Shared\Infrastructure\Bus;

use App\Core\Application\Command\CreatePromptCommand;
use App\Core\Application\CommandHandler\CreatePromptCommandHandler;
use App\Entity\MessageLogger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Uid\Uuid;

class MessageLoggerMiddleware implements MiddlewareInterface{
	public function __construct(private EntityManagerInterface $entityManager){
	}

	public function handle(
		Envelope $envelope,
		StackInterface $stack
	): Envelope{
		$message = $envelope->getMessage();

		if (!($message instanceof CreatePromptCommand)){
			return $stack->next()
				->handle($envelope,
					$stack);
		}
		$request_id = $message->requestId?->value();

		$messageLog = $this->entityManager->createQueryBuilder()
			->select('m')
			->from(MessageLogger::class, 'm')
			->where('m.requestId = :requestId')
			->setParameter('requestId', $request_id)
			->getQuery()
			->getOneOrNullResult();

		if ($messageLog){
			return $stack
				->next()
				->handle($envelope,$stack);
		}

		$messageData = [
			'prompt' => $message?->prompt ? $message->prompt?->value() : null,
			'userId' => $message?->userId ? $message->userId?->value() : null,
			'requestId' => $request_id,
		];

		$messageLog = new MessageLogger(json_encode($messageData),'pending',$request_id);

		$this->entityManager->persist($messageLog);
		$this->entityManager->flush();
		return $stack
			->next()
			->handle(
				$envelope,
				$stack
			);
	}
}
