<?php

namespace App\Tests\src\Books;

use App\Books\Application\Find\BookFinder;
use App\Books\Domain\Book;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookId;
use App\Tests\src\Shared\Infrastructure\PhpUnit\UnitTestCase;

abstract class BookUnitTest extends UnitTestCase
{
    private ?BookRepository $bookRepository = null;
    private ?BookFinder $bookFinder = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = $this->createMock(BookRepository::class);
        $this->bookFinder = $this->createMock(BookFinder::class);
    }

    protected function shouldSave(Book $book): void
    {
        $this->repository()
            ->expects(self::exactly(1))
            ->method('save')
            ->with($this->isSimilar($book, ['domainEvents']));
    }

    protected function shouldFind(BookId $bookId, ?Book $book): void
    {
        $this->repository()
            ->expects(self::exactly(1))
            ->method('search')
            ->with($bookId)
            ->willReturn($book);
    }

    protected function repository(): BookRepository
    {
        return $this->bookRepository;
    }

    protected function finder(): BookFinder
    {
        return $this->bookFinder;
    }
}
