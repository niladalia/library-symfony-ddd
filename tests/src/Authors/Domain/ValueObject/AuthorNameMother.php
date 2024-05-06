<?php

namespace App\Tests\src\Authors\Domain\ValueObject;

use App\Authors\Domain\ValueObject\AuthorName;
use Faker\Factory;

final class AuthorNameMother
{
    public static function create(?string $value = null): AuthorName
    {
        return new AuthorName($value ?? Factory::create()->words(mt_rand(2, 3), true));
    }
}
