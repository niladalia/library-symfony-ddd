<?php

namespace App\Books\Infrastructure\Handlers;

use App\Authors\Application\Delete\DeleteAuthor;
use App\Authors\Application\Delete\DeleteAuthorCommand;
use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Application\Find\FindAuthorQuery;
use App\Authors\Application\Find\FindAuthorResponse;
use App\Authors\Domain\ValueObject\AuthorId;
use App\Books\Domain\BookDeletedDomainEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Psr\Log\LoggerInterface;

class BookDeletedDomainEventHandler
{
    public function __construct(
        private LoggerInterface $logger,
        private QueryBus $queryBus,
        private CommandBus $commandBus
    ) {}

    public function __invoke(BookDeletedDomainEvent $event)
    {
        $this->logger->info(sprintf('Book ID %s was deleted. ', $event->aggregateId()));
        $authorId = $event->authorId();

        if (!$authorId) {
            return;
        }
        /** @var FindAuthorResponse $response */
        $response = $this->queryBus->ask(new FindAuthorQuery($authorId));

        if(count($response->books()) == 0){
            $this->commandBus->dispatch(new DeleteAuthorCommand($authorId));
        }

    }
}
