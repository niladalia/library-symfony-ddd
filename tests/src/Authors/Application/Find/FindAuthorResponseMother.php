<?php

namespace App\Tests\src\Authors\Application\Find;

use App\Authors\Application\Find\FindAuthorResponse;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorNameMother;

class FindAuthorResponseMother
{
    public static function create(?string $id, ?string $name, ?array $books): FindAuthorResponse
    {
        return new FindAuthorResponse(
            $id ?? AuthorIdMother::create(),
            $name ?? AuthorNameMother::create(),
            $books ?? []
        );
    }
}
