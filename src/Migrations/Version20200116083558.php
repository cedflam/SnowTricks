<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116083558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD id_author_id INT DEFAULT NULL, ADD id_tricks_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C76404F3C FOREIGN KEY (id_author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBB208D73 FOREIGN KEY (id_tricks_id) REFERENCES tricks (id)');
        $this->addSql('CREATE INDEX IDX_9474526C76404F3C ON comment (id_author_id)');
        $this->addSql('CREATE INDEX IDX_9474526CBB208D73 ON comment (id_tricks_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C76404F3C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBB208D73');
        $this->addSql('DROP INDEX IDX_9474526C76404F3C ON comment');
        $this->addSql('DROP INDEX IDX_9474526CBB208D73 ON comment');
        $this->addSql('ALTER TABLE comment DROP id_author_id, DROP id_tricks_id');
    }
}
