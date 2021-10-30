<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029153738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY(book_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_tag (book_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F2F4CE1516A2B381 (book_id), INDEX IDX_F2F4CE15BAD26311 (tag_id), PRIMARY KEY(book_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_edition (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, editorial_id INT NOT NULL, edition SMALLINT NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, INDEX IDX_3BB1308916A2B381 (book_id), INDEX IDX_3BB13089BAF1A24D (editorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_edition_lang (id INT AUTO_INCREMENT NOT NULL, translator_id INT NOT NULL, book_edition_id INT NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, INDEX IDX_D8DFA5245370E40B (translator_id), INDEX IDX_D8DFA524EB8550ED (book_edition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, editorial_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, INDEX IDX_CCF1F1BABAF1A24D (editorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editorial (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_modification_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_tag ADD CONSTRAINT FK_F2F4CE1516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_tag ADD CONSTRAINT FK_F2F4CE15BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_edition ADD CONSTRAINT FK_3BB1308916A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_edition ADD CONSTRAINT FK_3BB13089BAF1A24D FOREIGN KEY (editorial_id) REFERENCES editorial (id)');
        $this->addSql('ALTER TABLE book_edition_lang ADD CONSTRAINT FK_D8DFA5245370E40B FOREIGN KEY (translator_id) REFERENCES translator (id)');
        $this->addSql('ALTER TABLE book_edition_lang ADD CONSTRAINT FK_D8DFA524EB8550ED FOREIGN KEY (book_edition_id) REFERENCES book_edition (id)');
        $this->addSql('ALTER TABLE editor ADD CONSTRAINT FK_CCF1F1BABAF1A24D FOREIGN KEY (editorial_id) REFERENCES editorial (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345F675F31B');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE book_tag DROP FOREIGN KEY FK_F2F4CE1516A2B381');
        $this->addSql('ALTER TABLE book_edition DROP FOREIGN KEY FK_3BB1308916A2B381');
        $this->addSql('ALTER TABLE book_edition_lang DROP FOREIGN KEY FK_D8DFA524EB8550ED');
        $this->addSql('ALTER TABLE book_edition DROP FOREIGN KEY FK_3BB13089BAF1A24D');
        $this->addSql('ALTER TABLE editor DROP FOREIGN KEY FK_CCF1F1BABAF1A24D');
        $this->addSql('ALTER TABLE book_tag DROP FOREIGN KEY FK_F2F4CE15BAD26311');
        $this->addSql('ALTER TABLE book_edition_lang DROP FOREIGN KEY FK_D8DFA5245370E40B');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE book_tag');
        $this->addSql('DROP TABLE book_edition');
        $this->addSql('DROP TABLE book_edition_lang');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE editorial');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE translator');
        $this->addSql('DROP TABLE user');
    }
}
