<?php

namespace App\Authors\Application\Delete;

use App\Shared\Domain\Bus\Command\CommandInterface;

final readonly class DeleteAuthorCommand implements CommandInterface
{
    public function __construct(private string $id) {}

    public function id(): ?string
    {
        return $this->id;
    }
}
