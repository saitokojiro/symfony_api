<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921115830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment_user ADD game_id INT DEFAULT NULL, CHANGE user username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_ABA574A5E48FD905 ON comment_user (game_id)');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CF8697D13');
        $this->addSql('DROP INDEX IDX_232B318CF8697D13 ON game');
        $this->addSql('ALTER TABLE game DROP comment_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5E48FD905');
        $this->addSql('DROP INDEX IDX_ABA574A5E48FD905 ON comment_user');
        $this->addSql('ALTER TABLE comment_user DROP game_id, CHANGE username user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE game ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CF8697D13 FOREIGN KEY (comment_id) REFERENCES comment_user (id)');
        $this->addSql('CREATE INDEX IDX_232B318CF8697D13 ON game (comment_id)');
    }
}
