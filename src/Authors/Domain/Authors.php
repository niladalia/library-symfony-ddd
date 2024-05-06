<?php

namespace App\Authors\Domain;

final class Authors
{
    private $authors;
    public function __construct(Author ...$authors)
    {
        $this->authors = $authors;
    }

    public function toArray(): array
    {
        $authors = [];

        foreach ($this->authors as $author) {
            $authors[] = $author->toArray();
        }

        return $authors;
    }
}
