<?php

namespace App\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class Validator
{
    public static function validate(mixed $data, Assert\Collection $constraint): void
    {
        $validationErrors =  Validation::createValidator()->validate($data, $constraint);

        if ($validationErrors->count() == 0) {
            return;
        }

        $errors_array = [];

        foreach ($validationErrors as $violation) {
            $errors_array[] = $violation->getPropertyPath() . " : " . $violation->getMessage();
        }
        throw new HttpException(400, json_encode($errors_array));
    }
}
