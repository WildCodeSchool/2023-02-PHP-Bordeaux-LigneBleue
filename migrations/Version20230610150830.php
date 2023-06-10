<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610150830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD proposition1 LONGTEXT NOT NULL, ADD proposition2 LONGTEXT NOT NULL, ADD proposition3 LONGTEXT DEFAULT NULL, ADD proposition4 LONGTEXT DEFAULT NULL, DROP proposition_1, DROP proposition_2, DROP proposition_3, DROP proposition_4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD proposition_1 LONGTEXT NOT NULL, ADD proposition_2 LONGTEXT NOT NULL, ADD proposition_3 LONGTEXT DEFAULT NULL, ADD proposition_4 LONGTEXT DEFAULT NULL, DROP proposition1, DROP proposition2, DROP proposition3, DROP proposition4');
    }
}
