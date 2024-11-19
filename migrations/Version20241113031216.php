<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113031216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_reservation (client_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_43836C6E19EB6921 (client_id), INDEX IDX_43836C6EB83297E7 (reservation_id), PRIMARY KEY(client_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_reservation ADD CONSTRAINT FK_43836C6E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_reservation ADD CONSTRAINT FK_43836C6EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9815D6E8B');
        $this->addSql('DROP INDEX IDX_F804D3B9815D6E8B ON employe');
        $this->addSql('ALTER TABLE employe DROP hotele_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_reservation DROP FOREIGN KEY FK_43836C6E19EB6921');
        $this->addSql('ALTER TABLE client_reservation DROP FOREIGN KEY FK_43836C6EB83297E7');
        $this->addSql('DROP TABLE client_reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE employe ADD hotele_id INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9815D6E8B FOREIGN KEY (hotele_id) REFERENCES hotele (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9815D6E8B ON employe (hotele_id)');
    }
}
