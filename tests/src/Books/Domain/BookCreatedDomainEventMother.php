<?php

namespace App\Tests\src\Books\Domain;

use App\Books\Domain\Book;
use App\Books\Domain\BookCreatedDomainEvent;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Books\Domain\ValueObject\BookDescriptionMother;
use App\Tests\src\Books\Domain\ValueObject\BookIdMother;
use App\Tests\src\Books\Domain\ValueObject\BookImageMother;
use App\Tests\src\Books\Domain\ValueObject\BookScoreMother;
use App\Tests\src\Books\Domain\ValueObject\BookTitleMother;

class BookCreatedDomainEventMother
{
    public static function create(
        string $id = null,
        string $title = null,
        string $author_id = null,
        string $base64Image = null,
        int    $score = null,
        string $description = null
    ): BookCreatedDomainEvent {
        return new BookCreatedDomainEvent(
            $id ?? BookIdMother::create()->getValue(),
            $title ?? BookTitleMother::create()->getValue(),
            $author_id ?? AuthorIdMother::create()->getValue(),
            $description ?? BookDescriptionMother::create()->getValue(),
            $score ?? BookScoreMother::create()->getValue(),
            $base64Image ?? BookImageMother::create()->getValue()
        );
    }

    public static function fromBook(Book $book): BookCreatedDomainEvent
    {
        return self::create(
            $book->getId()->getValue(),
            $book->title()->getValue(),
            $book->author()->getId()->getValue(),
            $book->image()->getValue(),
            $book->score()->getValue(),
            $book->description()->getValue()
        );
    }
}
