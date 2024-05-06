<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints as Assert;

abstract class ApiController extends AbstractController
{
    public function __construct() {}

    protected function validateRequest(mixed $request, Assert\Collection $constraints): void
    {
        if ($request == null) {
            throw new HttpException(400, 'Invalid DATA');
        }

        Validator::validate($request, $constraints);
    }
}
