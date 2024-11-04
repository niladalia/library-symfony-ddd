<?php

namespace App\Books\Infrastructure\Controllers;

use App\Books\Application\Find\BookFinder;
use App\Books\Application\Find\DTO\FindBookRequest;
use App\Books\Application\Find\DTO\FindBookResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookGetController extends AbstractController
{
    public function __invoke(string $id, BookFinder $bookFinder): JsonResponse
    {
        /** @var FindBookResponse $response */
        $bookResponse = $bookFinder->__invoke(
            new FindBookRequest($id)
        );

        return new JsonResponse(
            $bookResponse->data()
        );
    }
}
