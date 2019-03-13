<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190227092832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE client_cart_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client_cart_item (id INT NOT NULL, product_id INT NOT NULL, client_id INT NOT NULL, qty INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1BDEF5284584665A ON client_cart_item (product_id)');
        $this->addSql('CREATE INDEX IDX_1BDEF52819EB6921 ON client_cart_item (client_id)');
        $this->addSql('ALTER TABLE client_cart_item ADD CONSTRAINT FK_1BDEF5284584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_cart_item ADD CONSTRAINT FK_1BDEF52819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE client_cart_item_id_seq CASCADE');
        $this->addSql('DROP TABLE client_cart_item');
    }
}
