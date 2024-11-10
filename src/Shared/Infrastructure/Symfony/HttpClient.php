<?php

namespace App\Shared\Infrastructure\Symfony;

use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    private $httpClient;

    public function __construct(SymfonyHttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function request(string $method, string $url, ?array $options = []): ResponseInterface
    {
        return $this->httpClient->request($method, $url);
    }
}
