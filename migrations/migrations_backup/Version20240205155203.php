<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use CapCollectif\IdToUuid\IdToUuidMigration;

final class Version20240205155203 extends IdToUuidMigration
{
    public function postUp(Schema $schema): void
    {
        $this->migrate('books');
    }
}