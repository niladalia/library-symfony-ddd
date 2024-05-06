<?php

namespace App\Authors\Application\Find;

use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\Authors;

class AuthorsFinder
{
    private $author_rep;

    public function __construct(AuthorRepository $author_rep)
    {
        $this->author_rep = $author_rep;
    }

    public function __invoke(): Authors
    {
        $books = $this->author_rep->find_all();

        return $books;
    }
}
