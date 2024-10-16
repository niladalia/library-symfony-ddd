<?php

namespace App\Authors\Application\Find;

use App\Shared\Domain\Bus\Query\QueryInterface;

final readonly class FindAuthorQuery implements QueryInterface
{
    public function __construct(private string $id) {}

    public function id(): ?string
    {
        return $this->id;
    }
}
