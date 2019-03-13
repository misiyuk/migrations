<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190128105358 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE internal_code ADD act_invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internal_code ADD CONSTRAINT FK_9B95A1537559ABEA FOREIGN KEY (act_invoice_id) REFERENCES act_invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B95A1537559ABEA ON internal_code (act_invoice_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE internal_code DROP CONSTRAINT FK_9B95A1537559ABEA');
        $this->addSql('DROP INDEX UNIQ_9B95A1537559ABEA');
        $this->addSql('ALTER TABLE internal_code DROP act_invoice_id');
    }
}
