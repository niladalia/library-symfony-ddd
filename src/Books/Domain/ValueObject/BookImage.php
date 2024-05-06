<?php

namespace App\Books\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

final class BookImage extends StringValueObject
{
    public function __construct(?string $value = null)
    {
        parent::__construct($value);
    }

    protected function validate() {}
}
