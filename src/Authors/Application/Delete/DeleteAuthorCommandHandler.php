<?php

namespace App\Authors\Application\Delete;

use App\Authors\Domain\ValueObject\AuthorId;
use App\Shared\Domain\Bus\Command\CommandHandler;

final readonly class DeleteAuthorCommandHandler implements CommandHandler
{
    public function __construct(private DeleteAuthor $deleter) {}

    public function __invoke(DeleteAuthorCommand $command): void
    {
        $this->deleter->__invoke(new AuthorId($command->id()));
    }
}
