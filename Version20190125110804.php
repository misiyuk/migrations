<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190125110804 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE internal_code_id_seq');
        $this->addSql('SELECT setval(\'internal_code_id_seq\', (SELECT MAX(id) FROM internal_code))');
        $this->addSql('ALTER TABLE internal_code ALTER id SET DEFAULT nextval(\'internal_code_id_seq\')');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(false, 'ERROR!');
    }
}
