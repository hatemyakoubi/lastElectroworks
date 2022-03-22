<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907073403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE certificat_candidat (certificat_id INT NOT NULL, candidat_id INT NOT NULL, INDEX IDX_F041AC9FFA55BACF (certificat_id), INDEX IDX_F041AC9F8D0EB82 (candidat_id), PRIMARY KEY(certificat_id, candidat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE certificat_candidat ADD CONSTRAINT FK_F041AC9FFA55BACF FOREIGN KEY (certificat_id) REFERENCES certificat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE certificat_candidat ADD CONSTRAINT FK_F041AC9F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE certificat_candidat');
    }
}
