<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SymfonyQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $messengerQueryBus) {}

    public function ask(QueryInterface $query): Response
    {
        try {
            $response = $this->messengerQueryBus->dispatch($query);

            /** @var HandledStamp $handled */
            $handled = $response->last(HandledStamp::class);

            return $handled->getResult();
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious();
        }
    }
}
