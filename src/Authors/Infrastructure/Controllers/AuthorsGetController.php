<?php

namespace App\Authors\Infrastructure\Controllers;

use App\Authors\Application\Find\AuthorsFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorsGetController extends AbstractController
{
    public function __invoke(AuthorsFinder $authorsFinder): JsonResponse
    {
        $authors = $authorsFinder->__invoke();

        return new JsonResponse(
            $authors->toArray()
        );
    }
}
