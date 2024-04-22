<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240420165555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22708A0E0');
        $this->addSql('DROP INDEX IDX_8244BE22708A0E0 ON film');
        $this->addSql('ALTER TABLE film DROP gender_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD gender_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8244BE22708A0E0 ON film (gender_id)');
    }
}
