<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210116190603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD cases_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9662A69AB62 FOREIGN KEY (cases_id) REFERENCES country_cases (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9662A69AB62 ON country (cases_id)');
        $this->addSql('ALTER TABLE country_cases DROP FOREIGN KEY FK_BBFB1661F92F3E70');
        $this->addSql('DROP INDEX UNIQ_BBFB1661F92F3E70 ON country_cases');
        $this->addSql('ALTER TABLE country_cases DROP country_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C9662A69AB62');
        $this->addSql('DROP INDEX UNIQ_5373C9662A69AB62 ON country');
        $this->addSql('ALTER TABLE country DROP cases_id');
        $this->addSql('ALTER TABLE country_cases ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country_cases ADD CONSTRAINT FK_BBFB1661F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BBFB1661F92F3E70 ON country_cases (country_id)');
    }
}
