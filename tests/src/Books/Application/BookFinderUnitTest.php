<?php

namespace App\Tests\src\Books\Application;

use App\Books\Domain\BookFinder;
use App\Books\Domain\BookNotFound;
use App\Books\Domain\ValueObject\BookId;
use App\Tests\src\Books\BookUnitTest;
use App\Tests\src\Books\Domain\BookMother;
use App\Tests\src\Books\Domain\ValueObject\BookTitleMother;
use App\Tests\src\Shared\Domain\UuidMother;

class BookFinderUnitTest extends BookUnitTest
{
    private BookFinder $bookFinder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookFinder = new BookFinder(
            $this->repository()
        );
    }

    public function test_it_should_find_existing_book()
    {
        $bookId = new BookId(UuidMother::create());

        $existingBook = BookMother::create($bookId, BookTitleMother::create());

        $this->shouldFind($bookId, $existingBook);

        $book = $this->bookFinder->__invoke($bookId);

        $this->assertNotEmpty($book);
        $this->assertSame($existingBook, $book);
    }

    public function test_it_throws_exception_when_book_not_found()
    {
        $bookId = new BookId(UuidMother::create());

        $this->expectException(BookNotFound::class);

        $this->shouldFind($bookId, null);

        $this->bookFinder->__invoke($bookId);
    }
}
