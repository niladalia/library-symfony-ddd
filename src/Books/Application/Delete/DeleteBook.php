<?php

namespace App\Books\Application\Delete;

use App\Books\Domain\BookRepository;
use App\Books\Domain\BookFinder;
use App\Books\Domain\ValueObject\BookId;
use App\Shared\Domain\Event\EventBus;

class DeleteBook
{
    public function __construct(private BookRepository $bookRep, private BookFinder $bookFinder, private EventBus $bus) {}


    public function __invoke(string $id): void
    {
        $book = $this->bookFinder->__invoke(new BookId($id));

        $book->delete();

        $this->bookRep->delete($book);

        $this->bus->publish(...$book->pullDomainEvents());
    }
}
