<?php

namespace App\Books\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\IntValueObject;

final class BookScore extends IntValueObject
{
    protected function validate()
    {
        if ($this->value === null) {
            return null;
        }
        if ($this->value > 5 || $this->value < 0) {
            InvalidArgument::throw('El score tiene que estar entre 0 y 5');
        }
    }
}
