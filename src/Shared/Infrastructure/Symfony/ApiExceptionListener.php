<?php

namespace App\Shared\Infrastructure\Symfony;

use DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof HttpExceptionInterface) {
            Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $code = null;

        if ($exception instanceof HttpExceptionInterface || $exception instanceof DomainException) {
            $code = $exception->getStatusCode();
        } else {
            $code = 500;
        }

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $exception->getMessage(),
                #'trace' => $exception->getTrace()
            ]
        ];

        $event->setResponse(new JsonResponse($responseData, $code));
    }
}
