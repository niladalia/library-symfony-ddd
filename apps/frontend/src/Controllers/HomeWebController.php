<?php

namespace App\Apps\frontend\src\Controllers;

use App\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Response;

class HomeWebController extends WebController
{
    public function __invoke(): Response
    {
        return $this->render('home.html.twig', []);

    }
}