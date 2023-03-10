<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310204043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9F39F8B1E105BE6C ON station');
        $this->addSql('ALTER TABLE station CHANGE station_num station_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F39F8B121BDB235 ON station (station_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9F39F8B121BDB235 ON station');
        $this->addSql('ALTER TABLE station CHANGE station_id station_num INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F39F8B1E105BE6C ON station (station_num)');
    }
}
