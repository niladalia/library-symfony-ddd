<?php

// src/Doctrine/Types/AuthorIDType.php

namespace App\Authors\Infrastructure\Persistence\Doctrine;

use App\Authors\Domain\ValueObject\AuthorId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class AuthorIdType extends GuidType
{
    public function getName(): string
    {
        return 'author_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AuthorId
    {
        if ($value == null) {
            return null;
        }
        return new AuthorId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }
}
