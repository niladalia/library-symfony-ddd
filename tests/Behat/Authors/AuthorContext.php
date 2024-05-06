<?php

declare(strict_types=1);

namespace App\Tests\Behat\Authors;

use App\Tests\Behat\ApiContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

final class AuthorContext extends ApiContext
{
    public function __construct(KernelInterface $kernel, EntityManagerInterface $em)
    {
        parent::__construct($kernel, $em);
    }
}
