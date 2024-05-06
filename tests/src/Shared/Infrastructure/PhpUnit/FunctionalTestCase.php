<?php

namespace App\Tests\src\Shared\Infrastructure\PhpUnit;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestAssertionsTrait;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class FunctionalTestCase extends UnitTestCase
{
    use WebTestAssertionsTrait;

    protected function tearDown(): void
    {
        parent::tearDown();
        static::ensureKernelShutdown();
        self::getClient(null);
    }

    protected static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        if (static::$booted) {
            throw new \LogicException(sprintf('Booting the kernel before calling "%s()" is not supported, the kernel should only be booted once.', __METHOD__));
        }

        $kernel = static::bootKernel($options);

        try {
            $client = $kernel->getContainer()->get('test.client');
        } catch (ServiceNotFoundException) {
            if (class_exists(KernelBrowser::class)) {
                throw new \LogicException('You cannot create the client used in functional tests if the "framework.test" config is not set to true.');
            }
            throw new \LogicException('You cannot create the client used in functional tests if the BrowserKit component is not available. Try running "composer require symfony/browser-kit".');
        }

        $client->setServerParameters($server);

        return self::getClient($client);
    }
}
