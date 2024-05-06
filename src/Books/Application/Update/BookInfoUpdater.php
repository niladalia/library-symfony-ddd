<?php

namespace App\Books\Application\Update;

use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Books\Application\Update\DTO\UpdateBookInfoRequest;
use App\Books\Domain\Book;
use App\Books\Domain\BookFinder;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookDescription;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;
use App\Shared\Domain\Event\EventBus;

class BookInfoUpdater
{
    public function __construct(
        private BookRepository $book_rep,
        private BookFinder $bookFinder,
        private AuthorFinder $authorFinder,
        private EventBus $bus
    ) {}

    public function __invoke(UpdateBookInfoRequest $updateBookRequest): Book
    {
        $book = ($this->bookFinder)(new BookId($updateBookRequest->id()));

        $author = $updateBookRequest->author_id() ? ($this->authorFinder)(new AuthorId($updateBookRequest->author_id())) : null;

        $book->update(
            new BookTitle($updateBookRequest->title()),
            $author,
            new BookDescription($updateBookRequest->description()),
            new BookScore($updateBookRequest->score())
        );

        $book = $this->book_rep->save($book);

        $this->bus->publish(...$book->pullDomainEvents());

        return $book;
    }
}
