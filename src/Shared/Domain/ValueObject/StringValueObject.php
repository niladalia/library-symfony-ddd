<?php

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    protected ?string $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    abstract protected function validate();
}
