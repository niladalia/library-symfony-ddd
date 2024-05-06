<?php

namespace App\Authors\Application\Delete;

use App\Authors\Application\Find\AuthorFinder;
use App\Books\Domain\BookDeletedDomainEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CheckDeleteAuthorOnBookDelete implements EventSubscriberInterface
{
    public function __construct(private DeleteAuthor $deleteAuthor, private AuthorFinder $authorFinder) {}

    public static function getSubscribedEvents(): array
    {
        return [
            BookDeletedDomainEvent::class => [
                ['__invoke', 0]
            ],
        ];
    }

    public function __invoke(string $author_id)
    {
        if (!$author_id) {
            return null;
        }

        $author = $this->authorFinder->__invoke($author_id);
        if (count($author->getBooks()) == 0) {
            $this->deleteAuthor->__invoke($author);
        }
    }
}
