<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421142443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, gender_id INT DEFAULT NULL, adult TINYINT(1) NOT NULL, backdrop_path VARCHAR(255) NOT NULL, original_language VARCHAR(255) NOT NULL, original_title VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, popularity DOUBLE PRECISION NOT NULL, poster_path VARCHAR(255) NOT NULL, release_date DATE NOT NULL, title VARCHAR(255) NOT NULL, video TINYINT(1) NOT NULL, vote_average DOUBLE PRECISION NOT NULL, vote_count INT NOT NULL, INDEX IDX_8244BE22708A0E0 (gender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22708A0E0');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE gender');
    }
}
