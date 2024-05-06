<?php

declare(strict_types=1);

namespace App\Tests\src\Authors\Domain;

use App\Authors\Application\Create\CreateAuthorCommand;
use App\Authors\Domain\Author;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Authors\Domain\ValueObject\AuthorName;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorNameMother;

final class AuthorMother
{
    public static function create(?AuthorId $id = null, ?AuthorName $name = null): Author
    {
        return new Author(
            $id ?? AuthorIdMother::create(),
            $name ?? AuthorNameMother::create("MICHEL PEISSEL")
        );
    }

    public static function fromRequest(CreateAuthorCommand $request): Author
    {
        return self::create(
            AuthorIdMother::create($request->id()),
            AuthorNameMother::create($request->name())
        );
    }
}
