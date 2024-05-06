<?php

namespace App\Books\Application\Find;

use App\Books\Application\Create\DTO\FindBookRequest;
use App\Books\Domain\Book;
use App\Books\Domain\BookFinder as DomainBookFinder;
use App\Books\Domain\ValueObject\BookId;

class BookFinder
{
    public function __construct(private DomainBookFinder $domainBookFinder) {}

    public function __invoke(FindBookRequest $bookFinderRequest): Book
    {
        return $this->domainBookFinder->__invoke(new BookId($bookFinderRequest->id()));
    }
}
