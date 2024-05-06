<?php

namespace App\Tests\src\Authors\Application\Create;

use App\Authors\Application\Create\AuthorCreator;
use App\Authors\Application\Create\CreateAuthorCommandHandler;
use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Tests\src\Authors\AuthorUnitTest;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;

class CreateAuthorCommandHandlerTest extends AuthorUnitTest
{
    private $createAuthorHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createAuthorHandler = new CreateAuthorCommandHandler(
            new AuthorCreator($this->repository())
        );
    }

    public function test_it_creates_an_author()
    {
        $command = CreateAuthorCommandMother::create();

        $author = AuthorMother::fromRequest($command);

        $this->shouldSave($author);

        $this->dispatch($command, $this->createAuthorHandler);
    }

    public function test_it_throws_exception_when_data_is_invalid()
    {
        $this->expectException(InvalidArgument::class);

        $uuid = AuthorIdMother::create();

        $invalid_name = "AA";

        $command = CreateAuthorCommandMother::create($uuid->getValue(), $invalid_name);

        $this->dispatch($command, $this->createAuthorHandler);
    }
}
