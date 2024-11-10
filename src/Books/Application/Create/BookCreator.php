<?php

namespace App\Books\Application\Create;

use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Books\Application\Create\DTO\CreateBookRequest;
use App\Books\Domain\Book;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookDescription;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;
use App\Shared\Domain\Event\EventBus;

readonly class BookCreator
{
    public function __construct(
        private BookRepository $book_rep,
        private AuthorFinder $authorFinder,
        private EventBus $bus
    ) {}

    public function __invoke(CreateBookRequest $bookRequest)
    {
        $author = $bookRequest->author_id() ? $this->authorFinder->__invoke(new AuthorId($bookRequest->author_id())) : null;

        $book = Book::create(
            new BookId($bookRequest->id()),
            new BookTitle($bookRequest->title()),
            $author,
            new BookDescription($bookRequest->description()),
            new BookScore($bookRequest->score()),
            new BookImage(),
            $bookRequest->base64Image()
        );

        $this->book_rep->save($book);

        $this->bus->publish(...$book->pullDomainEvents());
    }
}
