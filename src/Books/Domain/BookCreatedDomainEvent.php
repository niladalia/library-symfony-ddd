<?php

namespace App\Books\Domain;

use App\Shared\Domain\Event\DomainEvent;

class BookCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $bookId,
        private readonly ?string $title,
        private readonly ?string $authorId,
        private readonly ?string $description,
        private readonly ?int $score,
        private readonly ?string $base64Image,
        string $eventId = null,
        string $occurred_on = null
    ) {
        parent::__construct($bookId, $eventId, $occurred_on);
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function authorId(): ?string
    {
        return $this->authorId;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function score(): ?int
    {
        return $this->score;
    }

    public function aggregateId(): ?string
    {
        return $this->bookId;
    }

    public function base64Image(): ?string
    {
        return $this->base64Image;
    }
    // TODO : Not correct
    public static function deserialize(
        string $aggregateId,
        array  $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['title'], $body['authorId'], $body['description'], $body['score'], $body['base64Image'], $eventId, $occurredOn);
    }

    public function serialize(): array
    {
        return [
            'bookId' => $this->aggregateId(),
            'title' => $this->title(),
            'authorId' => $this->authorId(),
            'description' => $this->description(),
            'score' => $this->score(),
            'base64Image' => $this->base64Image(),
            'eventId' => $this->eventId(),
            'occurred_on' => $this->occurredOn(),
        ];
    }

    public static function eventName(): string
    {
        return 'librarify.book.1.event.book.created';
    }
}
