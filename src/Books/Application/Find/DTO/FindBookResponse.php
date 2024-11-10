<?php

namespace App\Books\Application\Find\DTO;

class FindBookResponse
{
    public function __construct(
        private string $id,
        private string $title,
        private ?string $image,
        private ?float $score,
        private ?string $description,
        private ?array $author
    ) {}

    public function data(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'score' => $this->score,
            'description' => $this->description,
            'author' => $this->author,
        ];
    }
}
