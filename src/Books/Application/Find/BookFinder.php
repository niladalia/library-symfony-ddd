<?php

namespace App\Books\Application\Find;

use App\Books\Application\Find\DTO\FindBookRequest;
use App\Books\Application\Find\DTO\FindBookResponse;
use App\Books\Domain\BookFinder as DomainBookFinder;
use App\Books\Domain\ValueObject\BookId;

class BookFinder
{
    public function __construct(private DomainBookFinder $domainBookFinder) {}

    public function __invoke(FindBookRequest $bookFinderRequest): FindBookResponse
    {
        $book = $this->domainBookFinder->__invoke(new BookId($bookFinderRequest->id()));

        return new FindBookResponse(
            $book->getId()->getValue(),
            $book->title()->getValue(),
            $book->image()->getValue(),
            $book->score()->getValue(),
            $book->description()->getValue(),
            $book->author() ? $book->author()->toSmallArray() : null
        );
    }
}
