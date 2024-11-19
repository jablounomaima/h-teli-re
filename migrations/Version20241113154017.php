<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113154017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chaine_hotaliere_hotele (chaine_hotaliere_id INT NOT NULL, hotele_id INT NOT NULL, INDEX IDX_DC7C50FCF589B0BE (chaine_hotaliere_id), INDEX IDX_DC7C50FC815D6E8B (hotele_id), PRIMARY KEY(chaine_hotaliere_id, hotele_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele ADD CONSTRAINT FK_DC7C50FCF589B0BE FOREIGN KEY (chaine_hotaliere_id) REFERENCES chaine_hotaliere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele ADD CONSTRAINT FK_DC7C50FC815D6E8B FOREIGN KEY (hotele_id) REFERENCES hotele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rservation_service DROP FOREIGN KEY FK_F8ECD6CEA4887FC8');
        $this->addSql('ALTER TABLE rservation_service DROP FOREIGN KEY FK_F8ECD6CEED5CA9E6');
        $this->addSql('DROP TABLE rservation');
        $this->addSql('DROP TABLE rservation_service');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE admin CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849557F2DEE08 ON reservation (facture_id)');
        $this->addSql('ALTER TABLE room ADD reservation_id INT NOT NULL, ADD hotele_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B815D6E8B FOREIGN KEY (hotele_id) REFERENCES hotele (id)');
        $this->addSql('CREATE INDEX IDX_729F519BB83297E7 ON room (reservation_id)');
        $this->addSql('CREATE INDEX IDX_729F519B815D6E8B ON room (hotele_id)');
        $this->addSql('ALTER TABLE user ADD dtype VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rservation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rservation_service (rservation_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_F8ECD6CEA4887FC8 (rservation_id), INDEX IDX_F8ECD6CEED5CA9E6 (service_id), PRIMARY KEY(rservation_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rservation_service ADD CONSTRAINT FK_F8ECD6CEA4887FC8 FOREIGN KEY (rservation_id) REFERENCES rservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rservation_service ADD CONSTRAINT FK_F8ECD6CEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele DROP FOREIGN KEY FK_DC7C50FCF589B0BE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele DROP FOREIGN KEY FK_DC7C50FC815D6E8B');
        $this->addSql('DROP TABLE chaine_hotaliere_hotele');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE admin CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE client CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9BF396750');
        $this->addSql('ALTER TABLE employe CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557F2DEE08');
        $this->addSql('DROP INDEX UNIQ_42C849557F2DEE08 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP facture_id');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BB83297E7');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B815D6E8B');
        $this->addSql('DROP INDEX IDX_729F519BB83297E7 ON room');
        $this->addSql('DROP INDEX IDX_729F519B815D6E8B ON room');
        $this->addSql('ALTER TABLE room DROP reservation_id, DROP hotele_id');
        $this->addSql('ALTER TABLE user DROP dtype');
    }
}
