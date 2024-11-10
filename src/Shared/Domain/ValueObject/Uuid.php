<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    final public static function generate(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    final public function getValue(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public static function isValid(string $id): bool
    {
        return RamseyUuid::isValid($id);
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            InvalidArgument::throw('UUid format is not valid !.');
        }
    }
}
