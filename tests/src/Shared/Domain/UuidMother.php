<?php

declare(strict_types=1);

namespace App\Tests\src\Shared\Domain;

use App\Shared\Domain\ValueObject\Uuid;

final class UuidMother
{
    public static function create(): string
    {
        return Uuid::generate()->getValue();
    }
}
