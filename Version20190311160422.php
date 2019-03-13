<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190311160422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE ecommerce_category (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D3949745E237E06 ON ecommerce_category (name)');
        $this->addSql('CREATE INDEX IDX_9D394974727ACA70 ON ecommerce_category (parent_id)');
        $this->addSql('ALTER TABLE ecommerce_category ADD CONSTRAINT FK_9D394974727ACA70 FOREIGN KEY (parent_id) REFERENCES ecommerce_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql("INSERT INTO ecommerce_category (parent_id, name) VALUES (NULL, 'без категории')");
        $this->addSql('ALTER TABLE product ADD e_commerce_category_id INT NOT NULL DEFAULT 1');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB66874F5 FOREIGN KEY (e_commerce_category_id) REFERENCES ecommerce_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADB66874F5 ON product (e_commerce_category_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE ecommerce_category DROP CONSTRAINT FK_9D394974727ACA70');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADB66874F5');
        $this->addSql('DROP TABLE ecommerce_category');
        $this->addSql('DROP INDEX IDX_D34A04ADB66874F5');
        $this->addSql('ALTER TABLE product DROP e_commerce_category_id');
    }
}
