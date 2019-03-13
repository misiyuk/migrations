<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125110812 extends AbstractMigration
{

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('INSERT INTO internal_code(value, product_id) SELECT internal_code, id FROM product WHERE internal_code IS NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(false, 'ERROR!');
    }
}
