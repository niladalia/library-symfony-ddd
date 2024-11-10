<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Books\Domain\BookDeletedDomainEvent;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final class BookDeletedDomainEventDecoder implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $attributes = json_decode($encodedEnvelope['body'], true)['attributes'];

        $message = new BookDeletedDomainEvent(
            $attributes['aggregateId'],
            $attributes['authorId'],
            $attributes['eventId'],
            $attributes['occurred_on']
        );

        return new Envelope($message);
    }

    public function encode(Envelope $envelope): array
    {
        return [];
    }
}
