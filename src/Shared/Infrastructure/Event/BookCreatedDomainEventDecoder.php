<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Books\Domain\BookCreatedDomainEvent;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final class BookCreatedDomainEventDecoder implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $attributes = json_decode($encodedEnvelope['body'], true)['attributes'];

        $message = new BookCreatedDomainEvent(
            $attributes['bookId'],
            $attributes['title'],
            $attributes['authorId'],
            $attributes['description'],
            $attributes['score'],
            $attributes['base64Image'],
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
