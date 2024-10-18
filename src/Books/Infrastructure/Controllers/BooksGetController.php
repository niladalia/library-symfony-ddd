<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Find\BooksFinder;
use App\Books\Application\Find\Filter\FindBookByFilterRequest;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class BooksGetController extends ApiController
{
    public function __invoke(Request $request, BooksFinder $booksFinder): JsonResponse
    {
        $this->validateRequest($request->query->all(), $this->constraints());

        $title = $request->query->get('title');
        $score = $request->query->get('score');
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $requestBooksFinder = new FindBookByFilterRequest($title, $score, $limit, $offset);
        $books = $booksFinder->__invoke($requestBooksFinder);

        return new JsonResponse(
            $books->toArray()
        );
    }

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'title' => [new Assert\Optional(new Assert\Type('string'))],
                'score' => [ new Assert\Optional([new Assert\LessThanOrEqual(5), new Assert\GreaterThanOrEqual(0)])],
            ]
        );
    }
}
