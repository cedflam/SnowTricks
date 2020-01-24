<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200124130722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB208D73');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE tricks CHANGE picture picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBB208D73');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB208D73');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tricks CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP token');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBB208D73');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
