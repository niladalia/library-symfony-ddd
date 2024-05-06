<?php

namespace App\Tests\src\Authors\Domain\ValueObject;

use App\Authors\Domain\ValueObject\AuthorId;
use App\Tests\src\Shared\Domain\UuidMother;

final class AuthorIdMother
{
    public static function create(?string $value = null): AuthorId
    {
        return new AuthorId($value ?? UuidMother::create());
    }
}
