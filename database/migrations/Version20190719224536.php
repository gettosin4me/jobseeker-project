<?php

declare(strict_types=1);

namespace Jobseeker\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719224536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jobs (id INT AUTO_INCREMENT NOT NULL, 
            `created_by_user_id` VARCHAR(255) DEFAULT NULL,
            company VARCHAR(255) NOT NULL,
            title VARCHAR(255) DEFAULT NULL,
            position VARCHAR(255) DEFAULT NULL,
            `description` VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL UNIQUE,
            `password` VARCHAR(255) DEFAULT NULL,
            rate VARCHAR(255) DEFAULT NULL,
            salary_range VARCHAR(255) NOT NULL,
            total_candidate_needed INT(11) DEFAULT 15,
            minimum_qualification VARCHAR(11) DEFAULT `OND`,
            closing_date DATE DEFAULT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE jobs');
    }
}
