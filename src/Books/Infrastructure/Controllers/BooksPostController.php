<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Create\BookCreator;
use App\Books\Application\Create\DTO\CreateBookRequest;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class BooksPostController extends ApiController
{
    public function __invoke(Request $request, BookCreator $bookCreator): JsonResponse
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        // I generate the UUID in the controller for Testing and consistency proposes
        $bookId = Uuid::generate()->getValue();

        $bookDto = new CreateBookRequest(
            $bookId,
            $request_data['title'] ?? null,
            $request_data['author_id'] ?? null,
            $request_data['base64Image'] ?? null,
            $request_data['score'] ?? null,
            $request_data['description'] ?? null
        );

        $bookCreator->__invoke($bookDto);

        return new JsonResponse(["book_id" => $bookId], Response::HTTP_CREATED);
    }


    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'title' => [new Assert\NotBlank(), new Assert\Length(['min' => 3, 'max' => 255])],
                'base64Image' => [new Assert\Optional(new Assert\Type('string'))],
                'author_id' => [ new Assert\Optional(new Assert\Length(['min' => 15, 'max' => 100]))],
                'score' => [ new Assert\Optional([new Assert\LessThanOrEqual(5), new Assert\GreaterThanOrEqual(0)])],
                'description' => [ new Assert\Optional(new Assert\Length(['min' => 3, 'max' => 200]))]
            ]
        );
    }
}
