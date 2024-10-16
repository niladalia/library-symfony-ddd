<?php

namespace App\Books\Application\Update\DTO;

class UpdateBookInfoRequest
{
    public function __construct(
        private ?string $id = null,
        private ?string $title = null,
        private ?string $author_id = null,
        private ?int $score = null,
        private ?string $description = null
    ) {}

    public function id(): ?string
    {
        return $this->id;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function author_id(): ?string
    {
        return $this->author_id;
    }

    public function score(): ?int
    {
        return $this->score;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}
