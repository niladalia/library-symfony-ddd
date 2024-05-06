<?php

namespace App\Books\Domain;

use App\Authors\Domain\Author;
use App\Books\Domain\ValueObject\BookDescription;
use App\Books\Domain\ValueObject\BookId;
use App\Books\Domain\ValueObject\BookImage;
use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;
use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\Uuid;

class Book
{
    private array $domainEvents;

    public function __construct(
        private BookId           $id,
        private BookTitle        $title,
        private ?Author          $author,
        private ?BookDescription $description,
        private ?BookScore       $score,
        private ?BookImage       $image,
    ) {}

    public static function create(
        BookId           $bookId,
        BookTitle        $title,
        ?Author          $author,
        ?BookDescription $description,
        ?BookScore       $score,
        ?BookImage       $image,
        ?string          $base64img = null
    ): self {
        $book = new self(
            $bookId,
            $title,
            $author,
            $description,
            $score,
            $image
        );

        $book->addDomainEvent(
            new BookCreatedDomainEvent(
                $book->getId()->getValue(),
                $title->getValue(),
                $author?->getId()->getValue(),
                $description->getValue(),
                $score->getValue(),
                $base64img
            )
        );
        return $book;
    }

    public function update(
        BookTitle       $title,
        ?Author          $author,
        ?BookDescription $description,
        ?BookScore       $score
    ) {
        $this->updateTitle($title);
        $this->updateDescription($description);
        $this->updateScore($score);
        $this->updateAuthor($author);

        $this->addDomainEvent(
            new BookUpdatedDomainEvent(
                $this->getId()->getValue(),
                $title->getValue(),
                $author?->getId()->getValue(),
                $description->getValue(),
                $score->getValue()
            )
        );
    }

    public function delete(): void
    {
        $this->addDomainEvent(
            new BookDeletedDomainEvent(
                $this->getId()->getValue()
            )
        );
    }

    public function addDomainEvent(DomainEvent $event): void
    {
        $this->domainEvents[] = $event;
    }

    public function pullDomainEvents(): array
    {
        return $this->domainEvents;
    }

    public function getId(): BookId
    {
        return $this->id;
    }


    public function image(): ?BookImage
    {
        return $this->image;
    }

    public function updateImage(BookImage $image): void
    {
        $this->image = $image;
    }



    public function title(): BookTitle
    {
        return $this->title;
    }

    public function updateTitle(BookTitle $newTitle): void
    {
        if ($this->title != $newTitle) {
            $this->title = $newTitle;
        }
    }

    public function author(): ?Author
    {
        return $this->author;
    }

    public function updateAuthor(?Author $newAuthor): void
    {
        if ($this->author != $newAuthor) {
            $this->author = $newAuthor;
        }
    }

    public function updateScore(?BookScore $newScore): void
    {
        if ($this->score != $newScore) {
            $this->score = $newScore;
        }
    }

    public function score(): BookScore
    {
        return $this->score;
    }

    public function description(): BookDescription
    {
        return $this->description;
    }


    public function updateDescription(?BookDescription $newDescription): void
    {
        if ($this->description != $newDescription) {
            $this->description = $newDescription;
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'title' => $this->title()->getValue(),
            'image' => $this->image()->getValue(),
            'score' => $this->score()->getValue(),
            'description' => $this->description()->getValue(),
            'author' => $this->author() ? $this->author()->toSmallArray() : null
        ];
    }

    public function toSmallArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'title' => $this->title()->getValue()
        ];
    }
}
