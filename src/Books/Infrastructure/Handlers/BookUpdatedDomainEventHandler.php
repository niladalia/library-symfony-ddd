<?php

namespace App\Books\Infrastructure\Handlers;

use App\Books\Domain\BookUpdatedDomainEvent;
use Psr\Log\LoggerInterface;

class BookUpdatedDomainEventHandler
{
    public function __construct(private LoggerInterface $logger) {}

    public function __invoke(BookUpdatedDomainEvent $event)
    {
        $this->logger->info(sprintf('Book ID %s was updated. ', $event->aggregateId()));
    }
}
