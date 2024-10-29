<?php

namespace App\Books\Infrastructure\Handlers;

use App\Books\Domain\BookFinder;
use App\Books\Application\UploadFile\BookFileUploader;
use App\Books\Domain\BookCreatedDomainEvent;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;
use Psr\Log\LoggerInterface;

class BookCreatedDomainEventHandler
{
    public function __construct(
        private BookFileUploader $fileUploader,
        private BookFinder $bookFinder,
        private BookRepository $bookRep,
        private LoggerInterface $logger,
    ) {}

    public function __invoke(BookCreatedDomainEvent $event)
    {

        $this->logger->info(sprintf('Book ID %s was CREATED !!. ', $event->aggregateId()));

        $bookId = $event->aggregateId();

        $book = ($this->bookFinder)(new BookId($bookId));

        $filename = $event->base64Image() ? $this->fileUploader->__invoke($event->base64Image(), $bookId, $event->title()) : null;
        $book->updateImage(new BookImage($filename));

        $this->bookRep->save($book);
    }
}
