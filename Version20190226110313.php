<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190226110313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE client ADD city VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD address1 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD address2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD zip VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE client DROP city');
        $this->addSql('ALTER TABLE client DROP address1');
        $this->addSql('ALTER TABLE client DROP address2');
        $this->addSql('ALTER TABLE client DROP zip');
    }
}
