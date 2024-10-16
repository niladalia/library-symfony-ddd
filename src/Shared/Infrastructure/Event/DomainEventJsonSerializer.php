<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

final class DomainEventJsonSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $decoded = json_decode($encodedEnvelope['body'], true)['data'];

        return new Envelope($decoded);
    }

    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        return [
            'body' => json_encode([
                'event_id' => $message->eventId(),
                'type' => $message->eventName(),
                'attributes' => $message->serialize()
            ])
        ];
    }
}
