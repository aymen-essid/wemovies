<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421144331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_gender (film_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_ACB53748567F5183 (film_id), INDEX IDX_ACB53748708A0E0 (gender_id), PRIMARY KEY(film_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_gender ADD CONSTRAINT FK_ACB53748567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_gender ADD CONSTRAINT FK_ACB53748708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_gender DROP FOREIGN KEY FK_ACB53748567F5183');
        $this->addSql('ALTER TABLE film_gender DROP FOREIGN KEY FK_ACB53748708A0E0');
        $this->addSql('DROP TABLE film_gender');
    }
}
