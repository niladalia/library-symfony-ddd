<?php

namespace App\Tests\src\Shared\Infrastructure\PhpUnit;

use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventBus;
use App\Tests\src\Shared\Infrastructure\Doctrine\MysqlTestDatabaseCleaner;
use App\Tests\src\Shared\Infrastructure\IsSimilar;
use Doctrine\DBAL\Connection;
use Mockery\MockInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UnitTestCase extends KernelTestCase
{
    private EventBus|MockInterface|null $eventBus = null;

    protected function setUp(): void
    {
        $this->clearDatabase();
        $this->eventBus = $this->createMock(EventBus::class);
    }

    protected function tearDown(): void
    {
        static::ensureKernelShutdown();
        static::$class = null;
        static::$kernel = null;
        static::$booted = false;
    }

    protected function dispatch(CommandInterface $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    protected function ask(QueryInterface $query, callable $queryHandler): Response
    {
        return $queryHandler($query);
    }

    protected function eventBus(): EventBus | MockInterface
    {
        return $this->eventBus;
    }

    protected function shouldPublishDomainEvent(DomainEvent $event): void
    {
        $this->eventBus()
            ->expects(self::once())
            ->method('publish')
            ->with($this->isSimilar($event, []));
    }

    protected function clearDatabase(): void
    {
        $cleaner = new MysqlTestDatabaseCleaner(
            $this->getContainer()->get(Connection::class)
        );
        $cleaner->__invoke();
    }

    protected function isSimilar($expectedObject, array $excludedAttributes): IsSimilar
    {
        return new IsSimilar($expectedObject, $excludedAttributes);
    }
}
