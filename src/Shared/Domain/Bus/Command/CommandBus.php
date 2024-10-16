<?php

namespace App\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(CommandInterface $command): void;
}
