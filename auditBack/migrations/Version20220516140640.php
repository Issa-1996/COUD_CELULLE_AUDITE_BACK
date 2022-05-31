<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516140640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE courier_controleurs');
        $this->addSql('ALTER TABLE courier ADD controleur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CB13E6101 FOREIGN KEY (controleur_id) REFERENCES controleurs (id)');
        $this->addSql('CREATE INDEX IDX_CF134C7CB13E6101 ON courier (controleur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courier_controleurs (courier_id INT NOT NULL, controleurs_id INT NOT NULL, INDEX IDX_62FEA81CE3D8151C (courier_id), INDEX IDX_62FEA81C90C7B3D2 (controleurs_id), PRIMARY KEY(courier_id, controleurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81CE3D8151C FOREIGN KEY (courier_id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81C90C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CB13E6101');
        $this->addSql('DROP INDEX IDX_CF134C7CB13E6101 ON courier');
        $this->addSql('ALTER TABLE courier DROP controleur_id');
    }
}
