<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116131945 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE employee ADD roles JSON');
        $this->addSql("UPDATE employee SET roles = array_to_json(array[to_json(role)])");
        $this->addSql('ALTER TABLE employee DROP role');
        $this->addSql('ALTER TABLE employee ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE employee ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE employee ALTER username TYPE VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1F85E0677 ON employee (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX UNIQ_5D9F75A1F85E0677');
        $this->addSql('ALTER TABLE employee ADD role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE employee DROP roles');
        $this->addSql('ALTER TABLE employee ALTER username TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE employee ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE employee ALTER last_name DROP NOT NULL');
    }
}
