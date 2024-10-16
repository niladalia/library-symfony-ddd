<?php

namespace App\Shared\Domain\Exceptions;

use DomainException;

class InvalidData extends DomainException
{
    public static function throw(?string $message = "Invalid data")
    {
        throw new self($message);
    }

    public function getStatusCode()
    {
        return 400;
    }
}
