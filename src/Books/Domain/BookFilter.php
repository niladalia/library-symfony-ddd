<?php

namespace App\Books\Domain;

use App\Books\Domain\ValueObject\BookScore;
use App\Books\Domain\ValueObject\BookTitle;

class BookFilter
{
    public function __construct(
        private ?BookTitle $title = null,
        private ?BookScore $score =  null,
        private ?int $limit = null,
        private ?int $offset = null
    ) {}

    public function title(): ?BookTitle
    {
        return $this->title;
    }

    public function score(): ?BookScore
    {
        return $this->score;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function offset(): int
    {
        return $this->offset;
    }
}
