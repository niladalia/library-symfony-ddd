<?php

namespace App\Tests\src\Books\Domain\ValueObject;

use App\Books\Domain\ValueObject\BookTitle;
use Faker\Factory;

class BookTitleMother
{
    public static function create(?string $value = null): BookTitle
    {
        return new BookTitle($value ?? Factory::create()->words(mt_rand(2, 5), true));
    }
}
