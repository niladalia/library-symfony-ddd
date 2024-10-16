<?php

namespace App\Books\Infrastructure\Handlers;

use App\Books\Application\Create\DTO\FindBookRequest;
use App\Books\Domain\BookFinder;
use App\Books\Application\UploadFile\BookFileUploader;
use App\Books\Domain\BookCreatedDomainEvent;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;

class BookCreatedDomainEventHandler
{
    public function __construct(private BookFileUploader $fileUploader, private BookFinder $bookFinder, private BookRepository $bookRep) {}

    public function __invoke(BookCreatedDomainEvent $event)
    {
        $bookId = $event->aggregateId();

        $book = ($this->bookFinder)(new BookId($bookId));

        $filename = $event->base64Image() ? $this->fileUploader->__invoke($event->base64Image(), $bookId, $event->title()) : null;
        $book->updateImage(new BookImage($filename));

        $this->bookRep->save($book);
    }
}
