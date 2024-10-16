<?php

namespace App\Authors\Infrastructure\Controllers;

use App\Authors\Application\Delete\DeleteAuthorCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Response;

class AuthorsDeleteController extends ApiController
{
    public function __invoke(string $id, CommandBus $commandBus): Response
    {
        $commandBus->dispatch(new DeleteAuthorCommand($id));

        return new Response('', Response::HTTP_OK);
    }
}
