<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227164115 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE spend_category (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_599BD9FE5E237E06 ON spend_category (name)');
        $this->addSql('CREATE INDEX IDX_599BD9FE727ACA70 ON spend_category (parent_id)');
        $this->addSql('CREATE TABLE spend (id SERIAL NOT NULL, category_id INT NOT NULL, cost DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, comment TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql("INSERT INTO spend_category (parent_id, name) VALUES (NULL, 'без категории')");

        $this->addSql('CREATE INDEX IDX_ECD2273D12469DE2 ON spend (category_id)');
        $this->addSql('ALTER TABLE spend_category ADD CONSTRAINT FK_599BD9FE727ACA70 FOREIGN KEY (parent_id) REFERENCES spend_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE spend ADD CONSTRAINT FK_ECD2273D12469DE2 FOREIGN KEY (category_id) REFERENCES spend_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE spend_category DROP CONSTRAINT FK_599BD9FE727ACA70');
        $this->addSql('ALTER TABLE spend DROP CONSTRAINT FK_ECD2273D12469DE2');
        $this->addSql('DROP TABLE spend_category');
        $this->addSql('DROP TABLE spend');
    }
}
