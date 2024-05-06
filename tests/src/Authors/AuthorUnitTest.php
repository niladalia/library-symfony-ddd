<?php

namespace App\Tests\src\Authors;

use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Domain\Author;
use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Tests\src\Shared\Infrastructure\PhpUnit\UnitTestCase;

abstract class AuthorUnitTest extends UnitTestCase
{
    private ?AuthorRepository $authorRepository = null;
    private ?AuthorFinder $authorFinder = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authorRepository = $this->createMock(AuthorRepository::class);
        $this->authorFinder = $this->createMock(AuthorFinder::class);
    }

    protected function shouldSave(Author $author): void
    {
        $this->repository()
            ->expects(self::exactly(1))
            ->method('save')
            ->with($this->isSimilar($author, ['domainEvents']));
    }

    protected function shouldFind(AuthorId $authorId, ?Author $author): void
    {
        $this->repository()
            ->expects(self::exactly(1))
            ->method('search')
            ->with($authorId)
            ->willReturn($author);
    }

    protected function repository(): AuthorRepository
    {
        return $this->authorRepository;
    }

    protected function finder(): AuthorFinder
    {
        return $this->authorFinder;
    }
}
