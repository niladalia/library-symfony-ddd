<?php

namespace App\Shared\Domain\Event;

use RabbitMessengerBundle\Domain\Event\DomainEvent as BundleDomainEvent;
interface EventBus
{
    public function publish(BundleDomainEvent ...$domainEvents): void;
}
