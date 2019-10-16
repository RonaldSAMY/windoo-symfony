<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191011205129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_id INTEGER NOT NULL, pour INTEGER DEFAULT 0, contre INTEGER DEFAULT 0)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A1085645B6FEF7D ON vote (idea_id)');
        $this->addSql('ALTER TABLE idea ADD COLUMN date_creation DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE vote');
        $this->addSql('CREATE TEMPORARY TABLE __temp__idea AS SELECT id, idea FROM idea');
        $this->addSql('DROP TABLE idea');
        $this->addSql('CREATE TABLE idea (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea CLOB NOT NULL)');
        $this->addSql('INSERT INTO idea (id, idea) SELECT id, idea FROM __temp__idea');
        $this->addSql('DROP TABLE __temp__idea');
    }
}
