<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016152244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE idea (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, idea CLOB NOT NULL, date_creation DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_A8BCA4519EB6921 ON idea (client_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, roles CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, pour INTEGER DEFAULT 0, contre INTEGER DEFAULT 0)');
        $this->addSql('CREATE INDEX IDX_5A1085645B6FEF7D ON vote (idea_id)');
        $this->addSql('CREATE INDEX IDX_5A108564A76ED395 ON vote (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE idea');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
    }
}
