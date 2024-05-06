<?php

namespace App\Books\Domain;

use DomainException;

class BookNotFound extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Book {$id} not found");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
