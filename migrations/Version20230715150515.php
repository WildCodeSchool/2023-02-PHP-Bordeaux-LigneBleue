<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715150515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_title VARCHAR(255) NOT NULL, category_index_order INT DEFAULT NULL, category_icon_path VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, prompt LONGTEXT NOT NULL, proposition1 LONGTEXT NOT NULL, proposition2 LONGTEXT NOT NULL, proposition3 LONGTEXT DEFAULT NULL, proposition4 LONGTEXT DEFAULT NULL, answer VARCHAR(255) NOT NULL, is_correct TINYINT(1) DEFAULT NULL, INDEX IDX_B6F7494E853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, tutorial_id INT NOT NULL, title VARCHAR(255) NOT NULL, questions_amount INT DEFAULT NULL, UNIQUE INDEX UNIQ_A412FA9289366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sequence (id INT AUTO_INCREMENT NOT NULL, tutorial_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, exercice TINYINT(1) NOT NULL, index_order INT DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, video_path VARCHAR(255) DEFAULT NULL, INDEX IDX_5286D72B89366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_tutorial (tag_id INT NOT NULL, tutorial_id INT NOT NULL, INDEX IDX_F05A8432BAD26311 (tag_id), INDEX IDX_F05A843289366B7B (tutorial_id), PRIMARY KEY(tag_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, index_order INT DEFAULT NULL, icon_path VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_9775E70812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, objective LONGTEXT DEFAULT NULL, is_published TINYINT(1) NOT NULL, index_order INT DEFAULT NULL, picture_path VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_C66BFFE959027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, gender VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, level INT NOT NULL, avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tutorial (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tutorial_id INT NOT NULL, is_validated TINYINT(1) NOT NULL, is_liked TINYINT(1) NOT NULL, is_started TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_26E61BE9A76ED395 (user_id), INDEX IDX_26E61BE989366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sequence ADD CONSTRAINT FK_5286D72B89366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
        $this->addSql('ALTER TABLE tag_tutorial ADD CONSTRAINT FK_F05A8432BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_tutorial ADD CONSTRAINT FK_F05A843289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E70812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE tutorial ADD CONSTRAINT FK_C66BFFE959027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE989366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9289366B7B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE sequence DROP FOREIGN KEY FK_5286D72B89366B7B');
        $this->addSql('ALTER TABLE tag_tutorial DROP FOREIGN KEY FK_F05A8432BAD26311');
        $this->addSql('ALTER TABLE tag_tutorial DROP FOREIGN KEY FK_F05A843289366B7B');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E70812469DE2');
        $this->addSql('ALTER TABLE tutorial DROP FOREIGN KEY FK_C66BFFE959027487');
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE9A76ED395');
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE989366B7B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE sequence');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_tutorial');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_tutorial');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
