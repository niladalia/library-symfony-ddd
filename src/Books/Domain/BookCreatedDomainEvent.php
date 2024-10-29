<?php

namespace App\Books\Domain;

use RabbitMessengerBundle\Domain\Event\DomainEvent;

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

    public static function deserialize(
        string $aggregateId,
        string $eventId,
        array  $attributes,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $aggregateId,
            $attributes['title'],
            $attributes['authorId'],
            $attributes['description'],
            $attributes['score'],
            $attributes['base64Image'],
            $eventId,
            $occurredOn
        );
    }

    public function serialize(): array
    {
        return [
            'title' => $this->title(),
            'authorId' => $this->authorId(),
            'description' => $this->description(),
            'score' => $this->score(),
            'base64Image' => $this->base64Image()
        ];
    }

    public static function eventName(): string
    {
        return 'librarify.book.1.event.book.created';
    }
}
