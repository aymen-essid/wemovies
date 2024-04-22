<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421135509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP name, DROP year, DROP description, DROP producer, DROP source, DROP image, DROP created_at, DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD name VARCHAR(255) NOT NULL, ADD year DATE NOT NULL, ADD description LONGTEXT NOT NULL, ADD producer VARCHAR(255) NOT NULL, ADD source LONGTEXT NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', ADD updated_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
