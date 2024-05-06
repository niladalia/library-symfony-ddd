<?php

namespace App\Tests\src\Authors\Infrastructure\Controllers;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorPostControllerTest extends WebTestCase
{
    public function test_create_author_success()
    {
        $client = static::createClient();

        $this->sendRequest($client, ["name" => "Michel Peissel"]);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function test_create_author_invalid_name()
    {
        $client = static::createClient();

        $this->sendRequest($client, ["name" => "Mi"]);

        $this->assertResponseStatusCodeSame(400);
    }

    private function sendRequest(KernelBrowser $client, array $request)
    {
        $client->request(
            'POST',
            '/api/author',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode($request)
        );
    }
}
