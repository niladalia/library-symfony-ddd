<?php

namespace App\Books\Application\Find\Filter;

class FindBookByFilter
{
    private const DEFAULT_LIMIT = 10;
    private const DEFAULT_OFFSET = 0;

    public function __construct(
        private ?string $title = null,
        private ?int $score =  null,
        private ?int $limit = null,
        private ?int $offset = null
    ) {
        $this->limit = $limit ?? self::DEFAULT_LIMIT;
        $this->offset = $offset ??  self::DEFAULT_OFFSET;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function score(): ?int
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
