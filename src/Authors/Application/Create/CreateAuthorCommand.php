<?php

namespace App\Authors\Application\Create;

use App\Shared\Domain\Bus\Command\CommandInterface;

final readonly class CreateAuthorCommand implements CommandInterface
{
    public function __construct(private ?string $id, private ?string $name) {}

    public function id(): ?string
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }
}
