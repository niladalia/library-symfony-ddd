<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Create\DTO\FindBookRequest;
use App\Books\Application\Find\BookFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookGetController extends AbstractController
{
    public function __invoke(string $id, BookFinder $bookFinder): JsonResponse
    {
        $bookFinderRequest = new FindBookRequest(
            $id
        );

        $book = $bookFinder->__invoke($bookFinderRequest);

        return new JsonResponse(
            $book->toArray()
        );
    }
}
