<?php

namespace App\Authors\Application\Find;

use App\Authors\Domain\Author;
use App\Authors\Domain\AuthorNotFound;
use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\ValueObject\AuthorId;

class AuthorFinder
{
    private $author_rep;

    public function __construct(AuthorRepository $author_rep)
    {
        $this->author_rep = $author_rep;
    }


    public function __invoke(AuthorId $id): Author
    {
        $author = $this->author_rep->search($id);
        if (!$author) {
            AuthorNotFound::throw($id->getValue());
        }
        return $author;
    }
}
