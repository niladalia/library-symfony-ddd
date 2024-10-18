<?php

namespace App\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Twig\Environment;

class WebController
{
    public function __construct(
        private readonly Environment $twig
    ) { }

    final public function render(string $templatePath, array $arguments = []): SymfonyResponse
    {
        return new SymfonyResponse($this->twig->render($templatePath, $arguments));
    }
}