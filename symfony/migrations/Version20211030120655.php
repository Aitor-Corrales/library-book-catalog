<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030120655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_edition ADD editor_id INT NOT NULL');
        $this->addSql('ALTER TABLE book_edition ADD CONSTRAINT FK_3BB130896995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('CREATE INDEX IDX_3BB130896995AC4C ON book_edition (editor_id)');
        $this->addSql('ALTER TABLE user ADD language VARCHAR(2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_edition DROP FOREIGN KEY FK_3BB130896995AC4C');
        $this->addSql('DROP INDEX IDX_3BB130896995AC4C ON book_edition');
        $this->addSql('ALTER TABLE book_edition DROP editor_id');
        $this->addSql('ALTER TABLE user DROP language');
    }
}
