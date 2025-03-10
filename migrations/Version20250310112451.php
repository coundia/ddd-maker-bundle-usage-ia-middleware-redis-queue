<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250310112451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files (id VARCHAR(255) NOT NULL, filename VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE message_loggers (id VARCHAR(36) NOT NULL, message CLOB NOT NULL, created_at DATETIME DEFAULT NULL, response CLOB DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, request_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prompts (id VARCHAR(36) NOT NULL, prompt CLOB NOT NULL, user_id VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, response CLOB DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, request_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE message_loggers');
        $this->addSql('DROP TABLE prompts');
    }
}
