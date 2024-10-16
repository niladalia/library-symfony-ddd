<?php

namespace App\Tests\src\Authors\Application\Find;

use App\Authors\Application\Find\AuthorFinder;
use App\Authors\Application\Find\FindAuthorQueryHandler;
use App\Tests\src\Authors\AuthorUnitTest;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;

class FindAuthorQueryHandlerTest extends AuthorUnitTest
{
    private $findAuthorHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->findAuthorHandler = new FindAuthorQueryHandler(
            new AuthorFinder($this->repository())
        );
    }

    public function test_it_should_find_author()
    {
        // Create the author
        $authorId = AuthorIdMother::create();
        $author = AuthorMother::create($authorId);
        // Create FindAuthorQuery based on the existing Author
        $query = FindAuthorQueryMother::create($authorId->getValue());
        // Create the expected response objectfrom the handler
        $response = FindAuthorResponseMother::create(
            $author->getId()->getValue(),
            $author->getName()->getValue(),
            $author->getBooks()->toSmallArray()
        );
        // call shouldFind() function
        $this->shouldFind($authorId, $author);
        // dispatch the Command
        $foundAuthor = $this->ask($query, $this->findAuthorHandler);
        // expect the response of the handler equals the expected response object
        $this->assertEquals($response, $foundAuthor);
    }
}
