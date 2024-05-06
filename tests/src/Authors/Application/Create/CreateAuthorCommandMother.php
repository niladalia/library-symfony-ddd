<?php

namespace App\Tests\src\Authors\Application\Create;

use App\Authors\Application\Create\CreateAuthorCommand;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorNameMother;

final class CreateAuthorCommandMother
{
    public static function create(?string $id = null, ?string $name = null): CreateAuthorCommand
    {
        return new CreateAuthorCommand(
            $id ?? AuthorIdMother::create()->getValue(),
            $name ?? AuthorNameMother::create()->getValue()
        );
    }
}
