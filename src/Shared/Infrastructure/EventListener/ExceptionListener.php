<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener implements \App\Shared\Application\EventListener\ExceptionListener
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $this->logger->error($exception->getMessage(), ['exception' => $exception]);

        $response = new JsonResponse([
            'success' => false,
            'code' => $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500,
            'message' => $exception->getMessage(),
            'data' => [$exception::class],
        ], $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500);

        $event->setResponse($response);
    }
}
