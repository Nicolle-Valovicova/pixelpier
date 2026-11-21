<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261121150819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workshops CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE capacity capacity SMALLINT NOT NULL, CHANGE min_age min_age SMALLINT NOT NULL, CHANGE active active SMALLINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workshops CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE capacity capacity SMALLINT UNSIGNED NOT NULL, CHANGE min_age min_age TINYINT DEFAULT 10 NOT NULL, CHANGE active active TINYINT DEFAULT 1 NOT NULL');
    }
}
