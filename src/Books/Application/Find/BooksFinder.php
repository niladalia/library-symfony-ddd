<?php

namespace App\Books\Application\Find;

use App\Books\Application\Find\Filter\FindBookByFilter;
use App\Books\Domain\BookFilter;
use App\Books\Domain\BookRepository;
use App\Books\Domain\Books;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;

class BooksFinder
{
    public function __construct(private BookRepository $book_rep) {}


    public function __invoke(FindBookByFilter $booksFilter): Books
    {
        return $this->book_rep->findByFilter(
            new BookFilter(
                new BookTitle($booksFilter->title(), true),
                new BookScore($booksFilter->score()),
                $booksFilter->limit(),
                $booksFilter->offset()
            )
        );
    }
}
