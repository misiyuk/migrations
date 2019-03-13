<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190128132611 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sale_return ADD CONSTRAINT FK_D3FF31CDEF39B1CA FOREIGN KEY (retail_shift_uuid) REFERENCES retail_shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D3FF31CDEF39B1CA ON sale_return (retail_shift_uuid)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE sale_return DROP CONSTRAINT FK_D3FF31CDEF39B1CA');
        $this->addSql('DROP INDEX IDX_D3FF31CDEF39B1CA');
    }
}
