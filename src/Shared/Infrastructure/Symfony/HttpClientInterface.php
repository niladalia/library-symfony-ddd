<?php

namespace App\Shared\Infrastructure\Symfony;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface HttpClientInterface
{
    public function request(string $method, string $url, ?array $options = []): ResponseInterface;
}
