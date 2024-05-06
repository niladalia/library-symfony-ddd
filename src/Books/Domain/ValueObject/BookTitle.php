<?php

namespace App\Books\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

final class BookTitle extends StringValueObject
{
    public function __construct(?string $value = null, private bool $nullable = false)
    {
        parent::__construct($value);
    }

    protected function validate()
    {
        if ($this->value == null && !$this->nullable) {
            InvalidArgument::throw('El titulo no puede estar vacío');
        }

        if ($this->value == null && $this->nullable) {
            return null;
        }

        if (strlen($this->value) <= 2) {
            InvalidArgument::throw('El titulo tiene que tener un mínimo de 3 caracteres');
        }
    }
}
