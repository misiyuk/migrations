<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108164754 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("UPDATE report SET query = 'SELECT SUM(cash_sum) + SUM(cashless_sum) Sec, DATE(created_at) DateOnly FROM sale #WHERE##CONDITIONS# GROUP BY DateOnly ORDER BY DateOnly;' WHERE id = 1");
        $this->addSql("UPDATE report SET query = 'SELECT SUM(cost) costsum, DATE(date) Date FROM spend #WHERE##CONDITIONS# GROUP BY Date ORDER BY Date;' WHERE id = 2");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(false, 'ERROR.');
    }
}
