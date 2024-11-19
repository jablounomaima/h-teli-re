<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113031601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_client (reservation_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_8FB54DCEB83297E7 (reservation_id), INDEX IDX_8FB54DCE19EB6921 (client_id), PRIMARY KEY(reservation_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_client ADD CONSTRAINT FK_8FB54DCEB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_client ADD CONSTRAINT FK_8FB54DCE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_client DROP FOREIGN KEY FK_8FB54DCEB83297E7');
        $this->addSql('ALTER TABLE reservation_client DROP FOREIGN KEY FK_8FB54DCE19EB6921');
        $this->addSql('DROP TABLE reservation_client');
    }
}
