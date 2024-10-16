<?php

namespace App\Tests\src\Books\Domain\ValueObject;

use App\Books\Domain\ValueObject\BookId;
use App\Tests\src\Shared\Domain\UuidMother;

class BookIdMother
{
    public static function create(?string $value = null): BookId
    {
        return new BookId($value ?? UuidMother::create());
    }
}
