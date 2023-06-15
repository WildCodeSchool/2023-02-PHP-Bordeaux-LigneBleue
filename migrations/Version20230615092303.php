<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615092303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD category_title VARCHAR(255) NOT NULL, ADD category_icon_path VARCHAR(255) NOT NULL, DROP title, DROP icon_path, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE index_order category_index_order INT DEFAULT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON category');
        $this->addSql('ALTER TABLE category ADD title VARCHAR(255) NOT NULL, ADD icon_path VARCHAR(255) NOT NULL, DROP category_title, DROP category_icon_path, CHANGE id id INT NOT NULL, CHANGE category_index_order index_order INT DEFAULT NULL');
    }
}
