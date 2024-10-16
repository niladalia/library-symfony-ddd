<?php

namespace App\Authors\Application\Find;

use App\Shared\Domain\Bus\Query\Response;

final readonly class FindAuthorResponse implements Response
{
    public function __construct(private string $id, private string $name, private array $books) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function books(): array
    {
        return $this->books;
    }

    public function data(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'books' => $this->books()
        ];
    }
}
