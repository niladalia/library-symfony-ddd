<?php

namespace App\Shared\Domain\Event;

use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;
use DateTimeInterface;

abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly string $occurredOn;

    public function __construct(private string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        $date = new DateTimeImmutable();
        $this->eventId = $eventId ?: Uuid::generate();
        $this->occurredOn = $occurredOn ?: $date->format(DateTimeInterface::ATOM);
    }

    abstract public static function eventName(): string;

    abstract public static function deserialize(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;


    abstract public function serialize(): array;

    final public function eventId(): string
    {
        return $this->eventId;
    }

    final public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}
