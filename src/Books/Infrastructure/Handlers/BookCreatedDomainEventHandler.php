<?php

namespace App\Books\Infrastructure\Handlers;

use App\Books\Application\Find\BookFinder;
use App\Books\Application\UploadFile\BookFileUploader;
use App\Books\Domain\BookCreatedDomainEvent;
use App\Books\Domain\BookRepository;
use App\Books\Domain\ValueObject\BookImage;

class BookCreatedDomainEventHandler
{
    public function __construct(private BookFileUploader $fileUploader, private BookFinder $BookFinder, private BookRepository $bookRep) {}

    public function __invoke(BookCreatedDomainEvent $event)
    {
        $book = ($this->BookFinder)($event->aggregateId());

        $filename = $event->base64Image() ? $this->fileUploader->__invoke($event->base64Image(), $event->aggregateId(), $event->title()) : null;
        $book->updateImage(new BookImage($filename));

        $this->bookRep->save($book);
    }
}
