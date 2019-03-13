<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107141111 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE report (id SERIAL NOT NULL, query VARCHAR(1000) NOT NULL, title VARCHAR(1000) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE report_column (id SERIAL NOT NULL, report_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54A052E14BD2A4C0 ON report_column (report_id)');
        $this->addSql('CREATE TABLE report_condition (id SERIAL NOT NULL, report_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, entity VARCHAR(255) DEFAULT NULL, field_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9362E55B4BD2A4C0 ON report_condition (report_id)');
        $this->addSql('ALTER TABLE report_column ADD CONSTRAINT FK_54A052E14BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE report_condition ADD CONSTRAINT FK_9362E55B4BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("INSERT INTO report (query, title) VALUES ('SELECT SUM(cash_sum) + SUM(cashless_sum) Sec, DATE(created_at) DateOnly FROM sale #WHERE##CONDITIONS# GROUP BY DateOnly;', 'Выручка')");
        $this->addSql("INSERT INTO report_column (report_id, name) VALUES (1, 'Сумма за день')");
        $this->addSql("INSERT INTO report_column (report_id, name) VALUES (1, 'Дата')");
        $this->addSql("INSERT INTO report (query, title) VALUES ('SELECT SUM(cost) costsum, DATE(date) Date FROM spend #WHERE##CONDITIONS# GROUP BY Date;', 'Расходы')");
        $this->addSql("INSERT INTO report_column (report_id, name) VALUES (2, 'Сумма за день')");
        $this->addSql("INSERT INTO report_column (report_id, name) VALUES (2, 'Дата')");
        $this->addSql("INSERT INTO report_condition (report_id, value, name, entity, field_type) VALUES (1, 'created_at<=''#VALUE#''', 'Максимальная дата', '', 'Дата')");
        $this->addSql("INSERT INTO report_condition (report_id, value, name, entity, field_type) VALUES (1, 'created_at>=''#VALUE#''', 'Минимальная дата', '', 'Дата')");
        $this->addSql("INSERT INTO report_condition (report_id, value, name, entity, field_type) VALUES (2, 'category_id IN(#VALUE#)', 'Категория', 'AppBundle\Entity\SpendCategory|name', 'Список')");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE report_column DROP CONSTRAINT FK_54A052E14BD2A4C0');
        $this->addSql('ALTER TABLE report_condition DROP CONSTRAINT FK_9362E55B4BD2A4C0');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE report_column');
        $this->addSql('DROP TABLE report_condition');
    }
}
