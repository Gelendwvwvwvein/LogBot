<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310192729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request CHANGE `where` `where` INT NOT NULL, CHANGE whither whither INT NOT NULL, CHANGE destination destination INT NOT NULL, CHANGE sender sender INT NOT NULL, CHANGE robot_num robot_num INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request CHANGE `where` `where` INT UNSIGNED NOT NULL, CHANGE whither whither INT UNSIGNED NOT NULL, CHANGE destination destination INT UNSIGNED NOT NULL, CHANGE sender sender INT UNSIGNED NOT NULL, CHANGE robot_num robot_num INT UNSIGNED NOT NULL');
    }
}
