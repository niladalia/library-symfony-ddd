<?php

namespace App\Apps\frontend\src\Controllers\Authors;

use App\Books\Application\Find\BooksFinder;
use App\Books\Application\Find\Filter\FindBookByFilterRequest;
use App\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;

class GetAuthorsWebController extends WebController
{
    public function __invoke()
    {

        return $this->render('authors.html.twig', []);

    }
}