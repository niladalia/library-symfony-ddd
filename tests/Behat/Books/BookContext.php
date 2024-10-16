<?php

declare(strict_types=1);

namespace App\Tests\Behat\Books;

use App\Authors\Domain\Author;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookDescription;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;
use App\Tests\Behat\ApiContext;
use App\Tests\src\Books\Domain\BookMother;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

final class BookContext extends ApiContext
{
    public function __construct(private BookRepository $bookRepository, KernelInterface $kernel, EntityManagerInterface $em)
    {
        parent::__construct($kernel, $em);
    }

    /**
     * @Given there is a book with ID :bookID and title :title
     */
    public function thereIsABookWithIdAndTitle(string $bookID, string $title)
    {
        $book = BookMother::create(
            new BookId($bookID),
            new BookTitle($title),
            new BookImage(),
            null,
            new BookDescription(),
            new BookScore()
        );

        $this->bookRepository->save($book);
    }
}
