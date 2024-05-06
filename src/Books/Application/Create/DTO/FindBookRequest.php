<?php

namespace App\Books\Application\Create\DTO;

class FindBookRequest
{
    public function __construct(
        private ?string $id = null
    ) {}

    public function id(): ?string
    {
        return $this->id;
    }
}
