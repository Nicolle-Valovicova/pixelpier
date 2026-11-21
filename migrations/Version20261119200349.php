<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261119200349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD comment LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE workshops DROP title, DROP description, DROP host, DROP room, DROP start_time, DROP end_time, DROP capacity, DROP min_age, DROP active, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP comment');
        $this->addSql('ALTER TABLE workshops ADD title VARCHAR(120) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD host VARCHAR(80) NOT NULL, ADD room VARCHAR(40) NOT NULL, ADD start_time TIME NOT NULL, ADD end_time TIME NOT NULL, ADD capacity SMALLINT UNSIGNED NOT NULL, ADD min_age TINYINT DEFAULT 10 NOT NULL, ADD active TINYINT DEFAULT 1 NOT NULL, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
    }
}
