<?php

namespace App\Tests\src\Books\Domain\ValueObject;

use App\Books\Domain\ValueObject\BookDescription;
use Faker\Factory;

class BookDescriptionMother
{
    public static function create(?string $value = null): BookDescription
    {
        return new BookDescription($value ?? Factory::create()->words(mt_rand(2, 5), true));
    }
}
