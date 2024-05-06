<?php

// src/Doctrine/Types/AuthorIDType.php

namespace App\Books\Infrastructure\Persistence\Doctrine;

use App\Books\Domain\ValueObject\BookId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class BookIdType extends GuidType
{
    public function getName(): string
    {
        return 'book_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?BookId
    {
        return new BookId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }
}
