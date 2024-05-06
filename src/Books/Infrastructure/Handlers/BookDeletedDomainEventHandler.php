<?php

namespace App\Books\Infrastructure\Handlers;

use App\Books\Domain\BookDeletedDomainEvent;
use Psr\Log\LoggerInterface;

class BookDeletedDomainEventHandler
{
    public function __construct(private LoggerInterface $logger) {}

    public function __invoke(BookDeletedDomainEvent $event)
    {
        $this->logger->info(sprintf('Book ID %s was deleted. ', $event->aggregateId()));
    }
}
