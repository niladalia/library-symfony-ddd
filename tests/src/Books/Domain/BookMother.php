<?php

declare(strict_types=1);

namespace App\Tests\src\Books\Domain;

use App\Authors\Domain\Author;
use App\Books\Application\Create\DTO\CreateBookRequest;
use App\Books\Domain\Book;
use App\Books\Domain\ValueObject\BookDescription;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Books\Domain\ValueObject\BookDescriptionMother;
use App\Tests\src\Books\Domain\ValueObject\BookIdMother;
use App\Tests\src\Books\Domain\ValueObject\BookImageMother;
use App\Tests\src\Books\Domain\ValueObject\BookScoreMother;
use App\Tests\src\Books\Domain\ValueObject\BookTitleMother;

final class BookMother
{
    public static function create(
        ?BookId $id = null,
        ?BookTitle $title = null,
        ?BookImage $filename = null,
        ?Author $author = null,
        ?BookDescription $description = null,
        ?BookScore $score = null
    ): Book {
        return new Book(
            $id ?? BookIdMother::create(),
            $title ?? BookTitleMother::create(),
            $author,
            $description ?? BookDescriptionMother::create(),
            $score ?? BookScoreMother::create(),
            BookImageMother::create('')
        );
    }

    public static function createFromRequest(CreateBookRequest $request): Book
    {
        $author = $request->author_id() ? AuthorMother::create(AuthorIdMother::create($request->author_id(), )) : null;

        return self::create(
            new BookId($request->id()),
            new BookTitle($request->title()),
            new BookImage(null),
            $author,
            new BookDescription($request->description()),
            new BookScore($request->score())
        );
    }
}
