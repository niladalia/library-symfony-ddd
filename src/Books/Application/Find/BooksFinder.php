<?php

namespace App\Books\Application\Find;

use App\Books\Application\Find\DTO\RequestBooksFinder;
use App\Books\Domain\BookRepository;
use App\Books\Domain\Books;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;

class BooksFinder
{
    public function __construct(private BookRepository $book_rep) {}


    public function __invoke(RequestBooksFinder $requestBooksFinder): Books
    {
        return $this->book_rep->findByParams(
            new BookTitle($requestBooksFinder->title(), true),
            new BookScore($requestBooksFinder->score()),
            $requestBooksFinder->limit(),
            $requestBooksFinder->offset()
        );
    }
}
