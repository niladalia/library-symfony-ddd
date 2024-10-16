<?php

namespace App\Books\Domain;

use App\Books\Domain\ValueObject\BookId;

/**
 * Domain service for locating a book using only its ID.
 * Unlike the Application layer's finder, it doesn't rely on a FindBookRequest object, so its more usable for
 * the other services that requires to find a book by ID.
 */

class BookFinder
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function __invoke(BookId $id): Book
    {
        $book = $this->bookRepository->search($id);
        if (!$book) {
            BookNotFound::throw($id->getValue());
        }
        return $book;
    }
}
