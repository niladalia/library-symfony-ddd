<?php

namespace App\Authors\Application\Delete;

use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\BookAssociatedException;
use App\Authors\Domain\ValueObject\AuthorId;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

class DeleteAuthor
{
    public function __construct(
        private AuthorRepository $author_rep,
        private AuthorFinder $author_finder
    ) {}

    public function __invoke(AuthorId $authorId)
    {
        $author = $this->author_finder->__invoke($authorId);
        try {
            $this->author_rep->delete($author);
        } catch (ForeignKeyConstraintViolationException) {
            BookAssociatedException::throw($authorId->getValue());
        }
    }
}
