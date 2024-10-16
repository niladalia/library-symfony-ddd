<?php

namespace App\Authors\Infrastructure\Persistence;

use App\Authors\Domain\Author;
use App\Authors\Domain\AuthorRepository;
use App\Authors\Domain\Authors;
use App\Authors\Domain\ValueObject\AuthorId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAuthorRepository extends ServiceEntityRepository implements AuthorRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function search(AuthorId $id): ?Author
    {
        return $this->getEntityManager()->find(Author::class, $id);
    }

    public function find_all(): Authors
    {
        $all_authors = $this->findBy([]);

        return new Authors(...$all_authors);
    }


    public function save(Author $author): Author
    {
        $this->getEntityManager()->persist($author);
        $this->getEntityManager()->flush();
        return $author;
    }

    public function reload(Author $author): Author
    {
        $this->getEntityManager()->refresh($author);
        return $author;
    }

    public function delete(Author $author): void
    {
        $this->getEntityManager()->remove($author);
        $this->getEntityManager()->flush();
    }
}
