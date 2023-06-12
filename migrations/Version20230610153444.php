<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610153444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_tutorial (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tutorial_id INT NOT NULL, status TINYINT(1) NOT NULL, favorite TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_26E61BE9A76ED395 (user_id), UNIQUE INDEX UNIQ_26E61BE989366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE989366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE9A76ED395');
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE989366B7B');
        $this->addSql('DROP TABLE user_tutorial');
    }
}
