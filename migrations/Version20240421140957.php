<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421140957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, adult TINYINT(1) NOT NULL, backdrop_path VARCHAR(255) NOT NULL, original_language VARCHAR(255) NOT NULL, original_title VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, popularity DOUBLE PRECISION NOT NULL, poster_path VARCHAR(255) NOT NULL, release_date DATE NOT NULL, title VARCHAR(255) NOT NULL, video TINYINT(1) NOT NULL, vote_average DOUBLE PRECISION NOT NULL, vote_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gender ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A42567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_C7470A42567F5183 ON gender (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A42567F5183');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP INDEX IDX_C7470A42567F5183 ON gender');
        $this->addSql('ALTER TABLE gender DROP film_id');
    }
}
