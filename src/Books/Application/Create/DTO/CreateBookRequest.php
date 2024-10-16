<?php

namespace App\Books\Application\Create\DTO;

class CreateBookRequest
{
    public function __construct(
        private ?string $id = null,
        private ?string $title = null,
        private ?string $author_id = null,
        private ?string $base64Image = null,
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

    public function base64Image(): ?string
    {
        return $this->base64Image;
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
