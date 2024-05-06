<?php

namespace App\Books\Domain;

final class Books
{
    private $books;
    public function __construct(Book ...$books)
    {
        $this->books = $books;
    }

    public function toArray(): array
    {
        $books = [];

        foreach ($this->books as $book) {
            $books[] = $book->toArray();
        }

        return $books;
    }

    public function toSmallArray(): array
    {
        $books = [];

        foreach ($this->books as $book) {
            $books[] = $book->toSmallArray();
        }

        return $books;
    }
}
