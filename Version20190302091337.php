<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190302091337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("ALTER TABLE threshold ADD store_id UUID NOT NULL DEFAULT '20181025-915a-40fd-8090-f717125774b0'");
        $this->addSql('ALTER TABLE threshold ADD CONSTRAINT FK_EB7A2A96B092A811 FOREIGN KEY (store_id) REFERENCES store (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EB7A2A96B092A811 ON threshold (store_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE threshold DROP CONSTRAINT FK_EB7A2A96B092A811');
        $this->addSql('DROP INDEX IDX_EB7A2A96B092A811');
        $this->addSql('ALTER TABLE threshold DROP store_id');
    }
}
