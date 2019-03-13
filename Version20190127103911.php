<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190127103911 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sale_return ADD CONSTRAINT FK_D3FF31CDA5C455EA FOREIGN KEY (sale_act_id) REFERENCES act (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D3FF31CDA5C455EA ON sale_return (sale_act_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sale_return DROP CONSTRAINT FK_D3FF31CDA5C455EA');
        $this->addSql('DROP INDEX IDX_D3FF31CDA5C455EA');
    }
}
