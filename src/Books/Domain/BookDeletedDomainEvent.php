<?php

namespace App\Books\Domain;

use RabbitMessengerBundle\Domain\Event\DomainEvent;

class BookDeletedDomainEvent extends DomainEvent
{
    public function __construct(
        private string $bookId,
        private string $authorId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($bookId, $eventId, $occurredOn);
    }

    public function aggregateId(): ?string
    {
        return $this->bookId;
    }

    public function authorId(): string{
        return $this->authorId;
    }
    public static function deserialize(
        string $aggregateId,
        string $eventId,
        array  $attributes,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $attributes['authorId'], $eventId, $occurredOn);
    }

    public function serialize(): array
    {
        return [
            'aggregateId' => $this->aggregateId(),
            'authorId' => $this->authorId(),
            'eventId' => $this->eventId(),
            'occurred_on' => $this->occurredOn(),
        ];
    }

    public static function eventName(): string
    {
        return 'librarify.book.1.event.book.deleted';
    }
}
