<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223092345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, game_id INT NOT NULL, create_at DATETIME NOT NULL, content LONGTEXT NOT NULL, up_votes INT DEFAULT NULL, down_votes INT DEFAULT NULL, INDEX IDX_5F9E962A9B6B5FBA (account_id), INDEX IDX_5F9E962AE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games_genres (games_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_6AC30AA397FFC673 (games_id), INDEX IDX_6AC30AA36A3B2603 (genres_id), PRIMARY KEY(games_id, genres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games_languages (games_id INT NOT NULL, languages_id INT NOT NULL, INDEX IDX_8F17289997FFC673 (games_id), INDEX IDX_8F1728995D237A9A (languages_id), PRIMARY KEY(games_id, languages_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libraries (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, account_id INT NOT NULL, installed TINYINT(1) NOT NULL, game_time INT NOT NULL, last_used DATETIME DEFAULT NULL, INDEX IDX_3ADD55A9E48FD905 (game_id), INDEX IDX_3ADD55A99B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9B6B5FBA FOREIGN KEY (account_id) REFERENCES accounts (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AE48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
        $this->addSql('ALTER TABLE games_genres ADD CONSTRAINT FK_6AC30AA397FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_genres ADD CONSTRAINT FK_6AC30AA36A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_languages ADD CONSTRAINT FK_8F17289997FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_languages ADD CONSTRAINT FK_8F1728995D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE libraries ADD CONSTRAINT FK_3ADD55A9E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
        $this->addSql('ALTER TABLE libraries ADD CONSTRAINT FK_3ADD55A99B6B5FBA FOREIGN KEY (account_id) REFERENCES accounts (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9B6B5FBA');
        $this->addSql('ALTER TABLE libraries DROP FOREIGN KEY FK_3ADD55A99B6B5FBA');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AE48FD905');
        $this->addSql('ALTER TABLE games_genres DROP FOREIGN KEY FK_6AC30AA397FFC673');
        $this->addSql('ALTER TABLE games_languages DROP FOREIGN KEY FK_8F17289997FFC673');
        $this->addSql('ALTER TABLE libraries DROP FOREIGN KEY FK_3ADD55A9E48FD905');
        $this->addSql('ALTER TABLE games_genres DROP FOREIGN KEY FK_6AC30AA36A3B2603');
        $this->addSql('ALTER TABLE games_languages DROP FOREIGN KEY FK_8F1728995D237A9A');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE games_genres');
        $this->addSql('DROP TABLE games_languages');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE languages');
        $this->addSql('DROP TABLE libraries');
    }
}
