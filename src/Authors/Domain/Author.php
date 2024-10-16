<?php

namespace App\Authors\Domain;

use App\Authors\Domain\ValueObject\AuthorId;
use App\Authors\Domain\ValueObject\AuthorName;
use App\Books\Domain\Books;

class Author
{
    private $books;

    public function __construct(private AuthorId $id, private ?AuthorName $name)
    {
        $this->books = [];
    }


    public static function create(
        AuthorId $id,
        AuthorName $name
    ): self {
        $author = new self(
            $id,
            $name
        );

        return $author;
    }

    public function getId(): ?AuthorId
    {
        return $this->id;
    }

    public function getName(): ?AuthorName
    {
        return $this->name;
    }

    public function setName(?AuthorName $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBooks(): Books
    {
        return new Books(...$this->books);
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId()->getValue(),
            "name" => $this->getName()->getValue(),
            "books" => $this->getBooks()->toSmallArray()
        ];
    }

    public function toSmallArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            "name" => $this->getName()->getValue()
        ];
    }
}
