<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200628212042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE twitter_auth ADD consumer_key VARCHAR(255) DEFAULT NULL, ADD consumer_secret VARCHAR(255) DEFAULT NULL, ADD oauth_token VARCHAR(255) DEFAULT NULL, ADD oauth_token_secret VARCHAR(255) DEFAULT NULL, DROP password');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE twitter_auth ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP consumer_key, DROP consumer_secret, DROP oauth_token, DROP oauth_token_secret');
    }
}
