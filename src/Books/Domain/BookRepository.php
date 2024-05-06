<?php

namespace App\Books\Domain;

use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;

interface BookRepository
{
    public function search(BookId $id): ?Book;

    public function find_all(): ?Books;

    public function findByParams(?BookTitle $title, ?BookScore $score, ?int $limit, ?int $offset): ?Books;

    public function save(Book $book): void;

    public function reload(Book $book): Book;

    public function delete(Book $book): void;
}
