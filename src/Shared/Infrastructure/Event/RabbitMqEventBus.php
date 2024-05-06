<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventBus;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

final class RabbitMqEventBus implements EventBus
{
    private $bus;
    public const AMQP_NOPARAM = 0;
    public const AMQP_DURABLE = 2;

    public function __construct(MessageBusInterface $messengerBusEventAsync)
    {
        $this->bus = $messengerBusEventAsync;
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $routingKey = $domainEvent::eventName();
            $amqpStamp = [
                new AmqpStamp(
                    $routingKey,
                    self::AMQP_NOPARAM,
                    [
                        'content_type' => 'application/json',
                        'content_encoding' => 'utf-8',
                        'headers' => ['Content-Type' => 'application/json'],
                        'delivery_mode' => self::AMQP_DURABLE,
                        'priority' => 0,
                        'message_id' => $domainEvent->eventId(),
                        'timestamp' => $domainEvent->occurredOn(),
                        'type' => $domainEvent::eventName()
                    ]
                )
            ];

            $this->bus->dispatch($domainEvent, $amqpStamp);
        }
    }
}
