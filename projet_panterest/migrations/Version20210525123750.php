<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525123750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'add relation between user and paysages';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paysages ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE paysages ADD CONSTRAINT FK_69683D19A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_69683D19A76ED395 ON paysages (user_id)');
        $this->addSql('ALTER TABLE pizza ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paysages DROP FOREIGN KEY FK_69683D19A76ED395');
        $this->addSql('DROP INDEX IDX_69683D19A76ED395 ON paysages');
        $this->addSql('ALTER TABLE paysages DROP user_id');
        $this->addSql('ALTER TABLE pizza DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
