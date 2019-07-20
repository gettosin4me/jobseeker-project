<?php

declare(strict_types=1);

namespace Jobseeker\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717152859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'User Schema';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, 
            first_name VARCHAR(255) DEFAULT NULL,
            middle_name VARCHAR(255) DEFAULT NULL,
            last_name VARCHAR(255) DEFAULT NULL,
            gender VARCHAR(255) DEFAULT NULL,
            date_of_birth VARCHAR(255) DEFAULT NULL,
            state_of_origin VARCHAR(255) DEFAULT NULL,
            lga VARCHAR(255) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            mobile_number VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL UNIQUE,
            `password` VARCHAR(255) DEFAULT NULL,
            course_of_study VARCHAR(255) DEFAULT NULL,
            highest_qualification VARCHAR(255) DEFAULT NULL,
            step_completed VARCHAR(255) DEFAULT 1,
            survey_total INT(11) DEFAULT 0,
            is_admin TINYINT(4) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
    }
}
