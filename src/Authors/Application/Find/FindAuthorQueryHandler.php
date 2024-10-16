<?php

namespace App\Authors\Application\Find;

use App\Authors\Domain\ValueObject\AuthorId;
use App\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindAuthorQueryHandler implements QueryHandler
{
    public function __construct(private AuthorFinder $finder) {}

    public function __invoke(FindAuthorQuery $query): FindAuthorResponse
    {
        $author = $this->finder->__invoke(new AuthorId($query->id()));

        return new FindAuthorResponse(
            $author->getId()->getValue(),
            $author->getName()->getValue(),
            $author->getBooks()->toSmallArray()
        );
    }
}
