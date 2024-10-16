<?php

namespace App\Books\Infrastructure\Persistence\Doctrine;

use App\Books\Domain\Book;
use App\Books\Domain\BookFilter;
use App\Books\Domain\BookRepository;
use App\Books\Domain\Books;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Infrastructure\Persistence\DoctrineByGeoLocationFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineBookRepository extends ServiceEntityRepository implements BookRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function search(BookId $id): ?Book
    {
        return $this->getEntityManager()->find(Book::class, $id);
    }

    public function find_all(): ?Books
    {
        $all_books = $this->findBy([]);

        return new Books(...$all_books);
    }

    public function findByFilter(?BookFilter $filter): ?Books
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('book');
        $qb->from(Book::class, 'book');

        $qb = DoctrineFindBookByFilter::filter($qb, $filter);

        $books = $qb->getQuery()->getResult();

        return new Books(...$books);
    }

    public function save(Book $book): void
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
    }

    public function reload(Book $book): Book
    {
        $this->getEntityManager()->refresh($book);
        return $book;
    }

    public function delete(Book $book): void
    {
        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }

}
