<?php

namespace App\Tests\src\Books\Infrastructure\Controllers;

use App\Authors\Infrastructure\Persistence\DoctrineAuthorRepository;
use App\Books\Domain\ValueObject\BookScore;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorNameMother;
use App\Tests\src\Books\Domain\ValueObject\BookDescriptionMother;
use App\Tests\src\Books\Domain\ValueObject\BookScoreMother;
use App\Tests\src\Books\Domain\ValueObject\BookTitleMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookPostControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function testCreateComplexBookSuccess()
    {
        $client = $this->client;
        $authorId = AuthorIdMother::create();
        $author = AuthorMother::create($authorId);

        $authorRep = static::getContainer()->get(DoctrineAuthorRepository::class);

        $authorRep->save($author);

        $this->sendRequest(
            $client,
            [
                "title" => BookTitleMother::create()->getValue(),
                "score" => BookScoreMother::create()->getValue(),
                "description" => BookDescriptionMother::create()->getValue(),
                "author_id" => $authorId->getValue()
            ]
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }


    public function testCreateSimpleBookSuccess()
    {
        $client = $this->client;

        $this->sendRequest($client, ['title' => 'A title']);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testCreateBookWithoutContent()
    {
        $this->sendRequest($this->client, []);
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCreateBookInvalidData()
    {
        $this->sendRequest($this->client, ['title' => '']);
        $this->assertResponseStatusCodeSame(400);
    }

    public function testExpectAuthorNotFound()
    {
        $client = $this->client;
        $this->sendRequest($client, ['title' => 'LIBRO', "author_id" => "59aa8278-bd4a-4895-a9e1-5684c89a3628"]);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    private function sendRequest(KernelBrowser $client, array $data)
    {
        $client->request(
            'POST',
            '/api/book',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode($data)
        );
    }
}
