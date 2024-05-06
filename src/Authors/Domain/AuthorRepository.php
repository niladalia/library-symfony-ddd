<?php

namespace App\Authors\Domain;

use App\Authors\Domain\ValueObject\AuthorId;

interface AuthorRepository
{
    public function search(AuthorId $id): ?Author;

    public function find_all(): ?Authors;

    public function save(Author $book): Author;

    public function reload(Author $book): Author;

    public function delete(Author $book): void;
}
