<?php

namespace App\Shared\Infrastructure\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

class HttpException extends SymfonyHttpException
{
    public static function throw(string $message = '')
    {
        throw new self($message);
    }

    public function getStatusCode(): int
    {
        return 400;
    }
}
