<?php

namespace App\Authors\Infrastructure\Controllers;

use App\Authors\Application\Create\CreateAuthorCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorsPostController extends ApiController
{
    public function __invoke(Request $request, CommandBus $commandBus): Response
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        $commandBus->dispatch(
            new CreateAuthorCommand(
                Uuid::generate()->getValue(),
                (string) $request_data['name']
            )
        );


        return new Response('', Response::HTTP_CREATED);
    }


    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'name' => [new Assert\NotBlank(), new Assert\Length(['min' => 3, 'max' => 255])]
            ]
        );
    }
}
