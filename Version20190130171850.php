<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130171850 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        exec('php bin/console app:create-short-name');
    }

    public function down(Schema $schema) : void
    {

    }
}
