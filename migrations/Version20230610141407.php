<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610141407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sequence (id INT AUTO_INCREMENT NOT NULL, tutorial_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, exercice TINYINT(1) NOT NULL, index_order INT DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, video_path VARCHAR(255) DEFAULT NULL, INDEX IDX_5286D72B89366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sequence ADD CONSTRAINT FK_5286D72B89366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sequence DROP FOREIGN KEY FK_5286D72B89366B7B');
        $this->addSql('DROP TABLE sequence');
    }
}
