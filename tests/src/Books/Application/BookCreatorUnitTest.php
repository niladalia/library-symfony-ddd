<?php

namespace App\Tests\src\Books\Application;

use App\Authors\Application\Find\AuthorFinder;
use App\Books\Application\Create\BookCreator;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Books\Application\DTO\CreateBookRequestMother;
use App\Tests\src\Books\BookUnitTest;
use App\Tests\src\Books\Domain\BookCreatedDomainEventMother;
use App\Tests\src\Books\Domain\BookMother;
use App\Tests\src\Shared\Domain\UuidMother;

class BookCreatorUnitTest extends BookUnitTest
{
    private AuthorFinder $authorFinder;
    private BookCreator $bookCreator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authorFinder = $this->createMock(AuthorFinder::class);

        $this->bookCreator = new BookCreator(
            $this->repository(),
            $this->authorFinder,
            $this->eventBus(),
        );
    }

    public function test_it_creates_a_book(): void
    {
        $uuid = UuidMother::create();
        $author = AuthorMother::create(AuthorIdMother::create());

        $createBookRequest = CreateBookRequestMother::create(
            $uuid,
            "INTO THE WILD",
            $author->getId()->getValue(),
            ''
        );

        $book = BookMother::createFromRequest($createBookRequest);

        $domainEvent = BookCreatedDomainEventMother::fromBook($book);

        $this->authorFinder->expects(self::exactly(1))
        ->method('__invoke')
        ->with($author->getId()->getValue())
        ->willReturn($author);


        $this->shouldSave($book);

        $this->shouldPublishDomainEvent($domainEvent);

        $this->bookCreator->__invoke($createBookRequest);
    }
}
