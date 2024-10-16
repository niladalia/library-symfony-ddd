<?php

namespace App\Authors\Application\Create;

use App\Authors\Domain\ValueObject\AuthorId;
use App\Authors\Domain\ValueObject\AuthorName;
use App\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAuthorCommandHandler implements CommandHandler
{
    public function __construct(private AuthorCreator $creator) {}

    public function __invoke(CreateAuthorCommand $command): void
    {
        $id = new AuthorId($command->id());

        $name = new AuthorName($command->name());

        $this->creator->__invoke($id, $name);
    }
}
