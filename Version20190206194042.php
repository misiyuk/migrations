<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190206194042 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        exec('php bin/console app:update-act-type');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(false, 'ERROR');
    }
}
