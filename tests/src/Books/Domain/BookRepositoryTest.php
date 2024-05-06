<?php

namespace App\Tests\src\Books\Domain;

use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookId;
use App\Tests\src\Shared\Domain\UuidMother;
use App\Tests\src\Shared\Infrastructure\PhpUnit\UnitTestCase;

class BookRepositoryTest extends UnitTestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getContainer()->get(BookRepository::class);
    }

    /** @test */
    public function it_should_save_and_return_an_existing_book(): void
    {
        $bookId = new BookId(UuidMother::create());

        $book = BookMother::create($bookId);

        $this->repository->save($book);

        $this->assertEquals($book, $this->repository->search($book->getId()));
    }
}
