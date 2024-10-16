<?php

namespace App\Authors\Infrastructure\Controllers;

use App\Authors\Application\Create\CreateAuthorCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorsPostController extends ApiController
{
    public function __invoke(Request $request, CommandBus $commandBus): JsonResponse
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        // I generate the UUID in the controller for Testing and consistency proposes
        $authorId = Uuid::generate()->getValue();
        $commandBus->dispatch(
            new CreateAuthorCommand(
                $authorId,
                (string) $request_data['name']
            )
        );


        return new JsonResponse(["author_id" => $authorId], Response::HTTP_CREATED);
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
