<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Find\BooksFinder;
use App\Books\Application\Find\DTO\RequestBooksFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BooksGetController extends AbstractController
{
    public function __invoke(Request $request, BooksFinder $booksFinder): JsonResponse
    {
        $title = $request->query->get('title');
        $score = $request->query->get('score');
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $requestBooksFinder = new RequestBooksFinder($title, $score, $limit, $offset);
        $books = $booksFinder->__invoke($requestBooksFinder);

        return new JsonResponse(
            $books->toArray()
        );
    }
}
