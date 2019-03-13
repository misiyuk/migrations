<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190311171754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE ecommerce_tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ecommerce_tag (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A95818B727ACA70 ON ecommerce_tag (parent_id)');
        $this->addSql('CREATE TABLE ecommerce_tag_product (ecommerce_tag_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(ecommerce_tag_id, product_id))');
        $this->addSql('CREATE INDEX IDX_B83ACD8029DCFFCA ON ecommerce_tag_product (ecommerce_tag_id)');
        $this->addSql('CREATE INDEX IDX_B83ACD804584665A ON ecommerce_tag_product (product_id)');
        $this->addSql('ALTER TABLE ecommerce_tag ADD CONSTRAINT FK_5A95818B727ACA70 FOREIGN KEY (parent_id) REFERENCES ecommerce_tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ecommerce_tag_product ADD CONSTRAINT FK_B83ACD8029DCFFCA FOREIGN KEY (ecommerce_tag_id) REFERENCES ecommerce_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ecommerce_tag_product ADD CONSTRAINT FK_B83ACD804584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE ecommerce_tag DROP CONSTRAINT FK_5A95818B727ACA70');
        $this->addSql('ALTER TABLE ecommerce_tag_product DROP CONSTRAINT FK_B83ACD8029DCFFCA');
        $this->addSql('DROP SEQUENCE ecommerce_tag_id_seq CASCADE');
        $this->addSql('DROP TABLE ecommerce_tag');
        $this->addSql('DROP TABLE ecommerce_tag_product');
    }
}
