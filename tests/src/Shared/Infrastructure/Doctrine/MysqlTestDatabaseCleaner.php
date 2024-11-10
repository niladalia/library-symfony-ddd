<?php

namespace App\Tests\src\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;

class MysqlTestDatabaseCleaner
{
    public function __construct(private Connection $connection) {}

    public function __invoke(): void
    {
        $connection = $this->connection;
        $queries = $this->truncateTablesSql($connection->createSchemaManager()->listTableNames());
        $query =  sprintf('SET FOREIGN_KEY_CHECKS = 0; %s SET FOREIGN_KEY_CHECKS = 1;', $queries);
        $connection->executeQuery($query);
    }

    private function truncateTablesSql(array $tables): string
    {
        $queries = array_map(fn($table) => "TRUNCATE $table;", $tables);
        return implode('', $queries);
    }
}
