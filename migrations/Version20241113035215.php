<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113035215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rservation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rservation_service (rservation_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_F8ECD6CEA4887FC8 (rservation_id), INDEX IDX_F8ECD6CEED5CA9E6 (service_id), PRIMARY KEY(rservation_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rservation_service ADD CONSTRAINT FK_F8ECD6CEA4887FC8 FOREIGN KEY (rservation_id) REFERENCES rservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rservation_service ADD CONSTRAINT FK_F8ECD6CEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rservation_service DROP FOREIGN KEY FK_F8ECD6CEA4887FC8');
        $this->addSql('ALTER TABLE rservation_service DROP FOREIGN KEY FK_F8ECD6CEED5CA9E6');
        $this->addSql('DROP TABLE rservation');
        $this->addSql('DROP TABLE rservation_service');
    }
}
