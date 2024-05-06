<?php

namespace App\Shared\Domain\Bus\Query;

interface QueryBus
{
    public function ask(QueryInterface $query): ?Response;
}
