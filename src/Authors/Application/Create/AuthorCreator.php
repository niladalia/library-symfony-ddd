<?php

namespace App\Authors\Application\Create;

use App\Authors\Domain\Author;
use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Authors\Domain\ValueObject\AuthorName;

class AuthorCreator
{
    public function __construct(private AuthorRepository $author_rep) {}

    public function __invoke(AuthorId $id, AuthorName $name): Author
    {
        $author = Author::create(
            $id,
            $name
        );

        $this->author_rep->save($author);

        return $author;
    }
}
