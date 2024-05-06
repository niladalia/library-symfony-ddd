<?php

namespace App\Authors\Domain;

use DomainException;

class BookAssociatedException extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Author {$id} can not be deleted because it have associated books");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
