<?php

namespace App\Shared\Infrastructure\Symfony;

class GuzzleClient
{
    public function __construct() {}

    public function request(string $method, string $url, ?array $options = []) {}
}
