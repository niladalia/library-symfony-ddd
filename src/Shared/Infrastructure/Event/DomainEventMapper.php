<?php

namespace App\Shared\Infrastructure\Event;

use App\Books\Domain\BookCreatedDomainEvent;
use App\Books\Domain\BookDeletedDomainEvent;
use App\Books\Domain\BookUpdatedDomainEvent;
use App\Shared\Domain\Exceptions\InvalidArgument;
use RabbitMessengerBundle\Domain\Event\Mapper\DomainEventMapperInterface;
use RabbitMessengerBundle\Domain\Event\Mapper\DTO\DomainEventMappingDTO;
use Symfony\Component\Messenger\Envelope;

class DomainEventMapper implements DomainEventMapperInterface
{
    public function map(array $data): DomainEventMappingDTO
    {
        $type = $data['type'] ?? null;

        $map = [
            'aggregateId' => $data['aggregate_id'],
            'eventId' => $data['event_id'],
            'attributes' => $data['attributes'],
            'occurredOn' => $data['occurred_on']
        ];

        switch ($type) {
            case "librarify.book.1.event.book.created":
                $eventClass = BookCreatedDomainEvent::class;
                break;
            case "librarify.book.1.event.book.deleted":
                $eventClass = BookDeletedDomainEvent::class;
                break;
            case "librarify.book.1.event.book.updated":
                $eventClass = BookUpdatedDomainEvent::class;
                break;
        }

        if($eventClass === null) {
            InvalidArgument::throw(sprintf("Could not match class with type %s", $type));
        }


        return new DomainEventMappingDTO($eventClass, $map);
    }
}
