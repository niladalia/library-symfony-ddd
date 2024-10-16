<?php

namespace App\Tests\src\Books\Domain\ValueObject;

use App\Books\Domain\ValueObject\BookScore;
use Faker\Factory;

class BookScoreMother
{
    public static function create(?string $value = null): BookScore
    {
        return new BookScore($value ?? Factory::create()->numberBetween(0, 5));
    }
}
