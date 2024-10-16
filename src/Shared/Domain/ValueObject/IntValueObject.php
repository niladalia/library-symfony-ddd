<?php

namespace App\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    protected ?int $value;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    abstract protected function validate();
}
