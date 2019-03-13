<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311110220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE attribute_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE attribute_value_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE attribute (id INT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE attribute_option (id INT NOT NULL, attribute_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_78672EEAB6E62EFA ON attribute_option (attribute_id)');
        $this->addSql('CREATE TABLE attribute_value (id INT NOT NULL, product_id INT NOT NULL, attribute_id INT NOT NULL, value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE4FBB824584665A ON attribute_value (product_id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB82B6E62EFA ON attribute_value (attribute_id)');
        $this->addSql('CREATE TABLE attribute_value_attribute_option (attribute_value_id INT NOT NULL, attribute_option_id INT NOT NULL, PRIMARY KEY(attribute_value_id, attribute_option_id))');
        $this->addSql('CREATE INDEX IDX_74DC321C65A22152 ON attribute_value_attribute_option (attribute_value_id)');
        $this->addSql('CREATE INDEX IDX_74DC321C1AE56DE9 ON attribute_value_attribute_option (attribute_option_id)');
        $this->addSql('ALTER TABLE attribute_option ADD CONSTRAINT FK_78672EEAB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB824584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB82B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribute_value_attribute_option ADD CONSTRAINT FK_74DC321C65A22152 FOREIGN KEY (attribute_value_id) REFERENCES attribute_value (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribute_value_attribute_option ADD CONSTRAINT FK_74DC321C1AE56DE9 FOREIGN KEY (attribute_option_id) REFERENCES attribute_option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE attribute_option DROP CONSTRAINT FK_78672EEAB6E62EFA');
        $this->addSql('ALTER TABLE attribute_value DROP CONSTRAINT FK_FE4FBB82B6E62EFA');
        $this->addSql('ALTER TABLE attribute_value_attribute_option DROP CONSTRAINT FK_74DC321C1AE56DE9');
        $this->addSql('ALTER TABLE attribute_value_attribute_option DROP CONSTRAINT FK_74DC321C65A22152');
        $this->addSql('DROP SEQUENCE attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE attribute_option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE attribute_value_id_seq CASCADE');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_option');
        $this->addSql('DROP TABLE attribute_value');
        $this->addSql('DROP TABLE attribute_value_attribute_option');
    }
}
