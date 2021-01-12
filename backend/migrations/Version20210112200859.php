<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210112200859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE continent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, continent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, iso2 VARCHAR(255) NOT NULL, iso3 VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, flag VARCHAR(255) NOT NULL, population INT NOT NULL, INDEX IDX_5373C966921F4C77 (continent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country_cases (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, cases INT NOT NULL, today_cases INT NOT NULL, deaths INT NOT NULL, recovered INT NOT NULL, today_recovered INT NOT NULL, active INT NOT NULL, critical INT NOT NULL, cases_per_one_million INT NOT NULL, deaths_per_one_million INT NOT NULL, tests INT NOT NULL, tests_per_one_million INT NOT NULL, one_case_per_people INT NOT NULL, one_death_per_people INT NOT NULL, one_test_per_people INT NOT NULL, active_per_one_million DOUBLE PRECISION NOT NULL, recovered_per_one_million DOUBLE PRECISION NOT NULL, critical_per_one_million DOUBLE PRECISION NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_BBFB1661F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, country_source_id INT DEFAULT NULL, country_destination_id INT DEFAULT NULL, possible_path TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_32D5C2B320DF1901 (country_source_id), INDEX IDX_32D5C2B31D96D23B (country_destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id)');
        $this->addSql('ALTER TABLE country_cases ADD CONSTRAINT FK_BBFB1661F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B320DF1901 FOREIGN KEY (country_source_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B31D96D23B FOREIGN KEY (country_destination_id) REFERENCES country (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966921F4C77');
        $this->addSql('ALTER TABLE country_cases DROP FOREIGN KEY FK_BBFB1661F92F3E70');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B320DF1901');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B31D96D23B');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE country_cases');
        $this->addSql('DROP TABLE routes');
    }
}
