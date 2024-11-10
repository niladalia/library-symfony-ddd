<?php

namespace App\Books\Domain;

use App\Books\Domain\ValueObject\BookId;

interface BookRepository
{
    public function search(BookId $id): ?Book;

    public function find_all(): ?Books;

    public function findByFilter(?BookFilter $filter): ?Books;

    public function save(Book $book): void;

    public function reload(Book $book): Book;

    public function delete(Book $book): void;
}
