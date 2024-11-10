<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Update\BookInfoUpdater;
use App\Books\Application\Update\DTO\UpdateBookInfoRequest;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class BooksPutController extends ApiController
{
    public function __invoke(string $id, Request $request, BookInfoUpdater $bookUpdater): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->validateRequest($data, $this->constraints());

        $bookDto = new UpdateBookInfoRequest(
            $id,
            $data['title'] ?? null,
            $data['author_id'] ?? null,
            $data['score'] ?? null,
            $data['description'] ?? null
        );

        $book = $bookUpdater->__invoke($bookDto);

        return new JsonResponse(
            $book->toArray()
        );
    }

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'title' => [new Assert\NotBlank(), new Assert\Length(['min' => 3, 'max' => 255])],
                'author_id' => [ new Assert\Optional(), new Assert\Length(['min' => 15, 'max' => 100])],
                'score' => [ new Assert\Optional(), new Assert\LessThanOrEqual(5), new Assert\GreaterThanOrEqual(0)],
                'description' => [ new Assert\Optional(), new Assert\Length(['min' => 3, 'max' => 200])]
            ]
        );
    }
}
