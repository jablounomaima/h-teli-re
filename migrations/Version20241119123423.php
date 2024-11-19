<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119123423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, matricule INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaine_hotaliere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nb_des_hotels INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaine_hotaliere_hotele (chaine_hotaliere_id INT NOT NULL, hotele_id INT NOT NULL, INDEX IDX_DC7C50FCF589B0BE (chaine_hotaliere_id), INDEX IDX_DC7C50FC815D6E8B (hotele_id), PRIMARY KEY(chaine_hotaliere_id, hotele_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, matricule INT NOT NULL, point_de_fidelite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_reservation (client_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_43836C6E19EB6921 (client_id), INDEX IDX_43836C6EB83297E7 (reservation_id), PRIMARY KEY(client_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT NOT NULL, matricule INT NOT NULL, position VARCHAR(255) NOT NULL, salaire DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, matricule INT NOT NULL, prix INT NOT NULL, payement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotele (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(255) NOT NULL, nb_de_start INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, facture_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_42C849557F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_client (reservation_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_8FB54DCEB83297E7 (reservation_id), INDEX IDX_8FB54DCE19EB6921 (client_id), PRIMARY KEY(reservation_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, hotele_id INT NOT NULL, numero INT NOT NULL, type VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_729F519BB83297E7 (reservation_id), INDEX IDX_729F519B815D6E8B (hotele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, mdp VARCHAR(20) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele ADD CONSTRAINT FK_DC7C50FCF589B0BE FOREIGN KEY (chaine_hotaliere_id) REFERENCES chaine_hotaliere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele ADD CONSTRAINT FK_DC7C50FC815D6E8B FOREIGN KEY (hotele_id) REFERENCES hotele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_reservation ADD CONSTRAINT FK_43836C6E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_reservation ADD CONSTRAINT FK_43836C6EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE reservation_client ADD CONSTRAINT FK_8FB54DCEB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_client ADD CONSTRAINT FK_8FB54DCE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B815D6E8B FOREIGN KEY (hotele_id) REFERENCES hotele (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele DROP FOREIGN KEY FK_DC7C50FCF589B0BE');
        $this->addSql('ALTER TABLE chaine_hotaliere_hotele DROP FOREIGN KEY FK_DC7C50FC815D6E8B');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE client_reservation DROP FOREIGN KEY FK_43836C6E19EB6921');
        $this->addSql('ALTER TABLE client_reservation DROP FOREIGN KEY FK_43836C6EB83297E7');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9BF396750');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557F2DEE08');
        $this->addSql('ALTER TABLE reservation_client DROP FOREIGN KEY FK_8FB54DCEB83297E7');
        $this->addSql('ALTER TABLE reservation_client DROP FOREIGN KEY FK_8FB54DCE19EB6921');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BB83297E7');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B815D6E8B');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE chaine_hotaliere');
        $this->addSql('DROP TABLE chaine_hotaliere_hotele');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_reservation');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE hotele');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_client');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
