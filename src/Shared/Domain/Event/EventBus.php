<?php

namespace App\Shared\Domain\Event;

interface EventBus
{
    public function publish(DomainEvent ...$domainEvents): void;
}
