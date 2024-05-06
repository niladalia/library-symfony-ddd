<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Command\CommandInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\MessageBusInterface as MessageBus;

class SymfonyCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $messengerCommandBus) {}

    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->messengerCommandBus->dispatch($command);
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious();
        }
    }
}
