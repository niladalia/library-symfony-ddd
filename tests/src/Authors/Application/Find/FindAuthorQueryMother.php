<?php

namespace App\Tests\src\Authors\Application\Find;

use App\Authors\Application\Find\FindAuthorQuery;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;

final class FindAuthorQueryMother
{
    public static function create(?string $id = null): FindAuthorQuery
    {
        return new FindAuthorQuery(
            $id ?? AuthorIdMother::create()->getValue()
        );
    }
}
