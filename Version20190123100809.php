<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123100809 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE batch_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE batch_balance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE batch (id INT NOT NULL, act_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F80B52D4D1A55B28 ON batch (act_id)');
        $this->addSql('CREATE TABLE batch_balance (id INT NOT NULL, product_id INT NOT NULL, batch_id INT NOT NULL, stock_id UUID NOT NULL, qty INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FC2295A44584665A ON batch_balance (product_id)');
        $this->addSql('CREATE INDEX IDX_FC2295A4F39EBE7A ON batch_balance (batch_id)');
        $this->addSql('CREATE INDEX IDX_FC2295A4DCD6110 ON batch_balance (stock_id)');
        $this->addSql('ALTER TABLE batch ADD CONSTRAINT FK_F80B52D4D1A55B28 FOREIGN KEY (act_id) REFERENCES act (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE batch_balance ADD CONSTRAINT FK_FC2295A44584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE batch_balance ADD CONSTRAINT FK_FC2295A4F39EBE7A FOREIGN KEY (batch_id) REFERENCES batch (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE batch_balance ADD CONSTRAINT FK_FC2295A4DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "SequelizeMeta"');
        $this->addSql('DROP TABLE relocation_product');
        $this->addSql('ALTER TABLE product ALTER sync SET DEFAULT \'true\'');
        $this->addSql('ALTER TABLE relocation DROP CONSTRAINT fk_3c7eaf9a4b22818a');
        $this->addSql('ALTER TABLE relocation DROP CONSTRAINT fk_3c7eaf9ac094ffbe');
        $this->addSql('DROP INDEX idx_3c7eaf9a4b22818a');
        $this->addSql('DROP INDEX idx_3c7eaf9ac094ffbe');
        $this->addSql('ALTER TABLE relocation ADD from_act_id INT NOT NULL');
        $this->addSql('ALTER TABLE relocation ADD to_act_id INT NOT NULL');
        $this->addSql('ALTER TABLE relocation DROP from_stock_id');
        $this->addSql('ALTER TABLE relocation DROP to_stock_id');
        $this->addSql('ALTER TABLE relocation DROP created_at');
        $this->addSql('ALTER TABLE relocation ADD CONSTRAINT FK_3C7EAF9A5C9420F8 FOREIGN KEY (from_act_id) REFERENCES act (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relocation ADD CONSTRAINT FK_3C7EAF9AF77757B5 FOREIGN KEY (to_act_id) REFERENCES act (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C7EAF9A5C9420F8 ON relocation (from_act_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C7EAF9AF77757B5 ON relocation (to_act_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(false, 'Migration can only be executed safely on \'postgresql\'.');
    }
}
