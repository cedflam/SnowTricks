<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116084203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video ADD id_tricks_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CBB208D73 ON video (id_tricks_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBB208D73');
        $this->addSql('DROP INDEX IDX_7CC7DA2CBB208D73 ON video');
        $this->addSql('ALTER TABLE video DROP id_tricks_id');
    }
}
