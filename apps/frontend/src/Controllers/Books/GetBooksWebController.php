<?php

namespace App\Apps\frontend\src\Controllers\Books;

use App\Books\Application\Find\BooksFinder;
use App\Books\Application\Find\Filter\FindBookByFilterRequest;
use App\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;

class GetBooksWebController extends WebController
{
    public function __invoke(Request $request,BooksFinder $finder)
    {
        // We retrieve all books
        $title = $request->query->get('title');

        $finderRequest = new FindBookByFilterRequest($title);

        $books = $finder->__invoke($finderRequest);

        return $this->render('books.html.twig', [
            'books' => $books->toArray(), // 'books' is the key that will be available in the template
        ]);

    }
}