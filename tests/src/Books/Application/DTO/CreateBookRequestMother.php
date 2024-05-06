<?php

namespace App\Tests\src\Books\Application\DTO;

use App\Books\Application\Create\DTO\CreateBookRequest;
use App\Tests\src\Books\Domain\ValueObject\BookDescriptionMother;
use App\Tests\src\Books\Domain\ValueObject\BookIdMother;
use App\Tests\src\Books\Domain\ValueObject\BookImageMother;
use App\Tests\src\Books\Domain\ValueObject\BookScoreMother;
use App\Tests\src\Books\Domain\ValueObject\BookTitleMother;

class CreateBookRequestMother
{
    public static function create(
        string $id = null,
        string $title = null,
        string $author_id = null,
        string $base64Image = null,
        int    $score = null,
        string $description = null
    ): CreateBookRequest {
        return new CreateBookRequest(
            $id ?? BookIdMother::create()->getValue(),
            $title ?? BookTitleMother::create()->getValue(),
            $author_id,
            $base64Image ?? BookImageMother::create()->getValue(),
            $score ?? BookScoreMother::create()->getValue(),
            $description ?? BookDescriptionMother::create()->getValue()
        );
    }
}
