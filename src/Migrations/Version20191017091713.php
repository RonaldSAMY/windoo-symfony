<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017091713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_A8BCA4519EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__idea AS SELECT id, client_id, idea, date_creation FROM idea');
        $this->addSql('DROP TABLE idea');
        $this->addSql('CREATE TABLE idea (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, idea CLOB NOT NULL COLLATE BINARY, date_creation DATETIME DEFAULT NULL, CONSTRAINT FK_A8BCA4519EB6921 FOREIGN KEY (client_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO idea (id, client_id, idea, date_creation) SELECT id, client_id, idea, date_creation FROM __temp__idea');
        $this->addSql('DROP TABLE __temp__idea');
        $this->addSql('CREATE INDEX IDX_A8BCA4519EB6921 ON idea (client_id)');
        $this->addSql('DROP INDEX IDX_5A108564A76ED395');
        $this->addSql('DROP INDEX IDX_5A1085645B6FEF7D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vote AS SELECT id, idea_id, user_id, pour, contre FROM vote');
        $this->addSql('DROP TABLE vote');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, pour INTEGER DEFAULT 0, contre INTEGER DEFAULT 0, CONSTRAINT FK_5A1085645B6FEF7D FOREIGN KEY (idea_id) REFERENCES idea (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A108564A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vote (id, idea_id, user_id, pour, contre) SELECT id, idea_id, user_id, pour, contre FROM __temp__vote');
        $this->addSql('DROP TABLE __temp__vote');
        $this->addSql('CREATE INDEX IDX_5A108564A76ED395 ON vote (user_id)');
        $this->addSql('CREATE INDEX IDX_5A1085645B6FEF7D ON vote (idea_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_A8BCA4519EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__idea AS SELECT id, client_id, idea, date_creation FROM idea');
        $this->addSql('DROP TABLE idea');
        $this->addSql('CREATE TABLE idea (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, idea CLOB NOT NULL, date_creation DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO idea (id, client_id, idea, date_creation) SELECT id, client_id, idea, date_creation FROM __temp__idea');
        $this->addSql('DROP TABLE __temp__idea');
        $this->addSql('CREATE INDEX IDX_A8BCA4519EB6921 ON idea (client_id)');
        $this->addSql('DROP INDEX IDX_5A1085645B6FEF7D');
        $this->addSql('DROP INDEX IDX_5A108564A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vote AS SELECT id, idea_id, user_id, pour, contre FROM vote');
        $this->addSql('DROP TABLE vote');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, pour INTEGER DEFAULT 0, contre INTEGER DEFAULT 0)');
        $this->addSql('INSERT INTO vote (id, idea_id, user_id, pour, contre) SELECT id, idea_id, user_id, pour, contre FROM __temp__vote');
        $this->addSql('DROP TABLE __temp__vote');
        $this->addSql('CREATE INDEX IDX_5A1085645B6FEF7D ON vote (idea_id)');
        $this->addSql('CREATE INDEX IDX_5A108564A76ED395 ON vote (user_id)');
    }
}
