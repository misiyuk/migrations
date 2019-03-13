<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190305111440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE threshold_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE threshold_id_seq');
        $this->addSql('SELECT setval(\'threshold_id_seq\', (SELECT MAX(id) FROM threshold))');
        $this->addSql('ALTER TABLE threshold ALTER id SET DEFAULT nextval(\'threshold_id_seq\')');
        $this->addSql('ALTER TABLE threshold ALTER store_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE threshold ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE threshold ALTER store_id SET DEFAULT \'20181025-915a-40fd-8090-f717125774b0\'');
    }
}
