<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190313142739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("ALTER TABLE ecommerce_tag ADD slug VARCHAR(255) NOT NULL DEFAULT 'none'");
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A95818B989D9B62 ON ecommerce_tag (slug)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX UNIQ_5A95818B989D9B62');
        $this->addSql('ALTER TABLE ecommerce_tag DROP slug');
    }
}
