<?php

namespace App\Authors\Infrastructure\Controllers;

use App\Authors\Application\Find\FindAuthorQuery;
use App\Authors\Application\Find\FindAuthorResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorGetController extends ApiController
{
    public function __invoke(string $id, QueryBus $queryBus): JsonResponse
    {
        /** @var FindAuthorResponse $response */
        $response = $queryBus->ask(
            new FindAuthorQuery(
                $id
            )
        );

        return new JsonResponse(
            $response->data()
        );
    }
}
