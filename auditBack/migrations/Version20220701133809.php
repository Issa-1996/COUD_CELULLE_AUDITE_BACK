<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701133809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CC6C0B070');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CB13E6101');
        $this->addSql('DROP INDEX IDX_CF134C7CB13E6101 ON courier');
        $this->addSql('DROP INDEX UNIQ_CF134C7CC6C0B070 ON courier');
        $this->addSql('ALTER TABLE courier DROP controleur_id, DROP fiche_de_controle_id');
        $this->addSql('ALTER TABLE courier_arriver ADD controleurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD14390C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('CREATE INDEX IDX_279DD14390C7B3D2 ON courier_arriver (controleurs_id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD courrier_arriver_id INT DEFAULT NULL, CHANGE nom_controleur nom_controleur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279B3B430C5 FOREIGN KEY (courrier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59C3C279B3B430C5 ON fiche_de_controle (courrier_arriver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier ADD controleur_id INT DEFAULT NULL, ADD fiche_de_controle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CC6C0B070 FOREIGN KEY (fiche_de_controle_id) REFERENCES fiche_de_controle (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CB13E6101 FOREIGN KEY (controleur_id) REFERENCES controleurs (id)');
        $this->addSql('CREATE INDEX IDX_CF134C7CB13E6101 ON courier (controleur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF134C7CC6C0B070 ON courier (fiche_de_controle_id)');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD14390C7B3D2');
        $this->addSql('DROP INDEX IDX_279DD14390C7B3D2 ON courier_arriver');
        $this->addSql('ALTER TABLE courier_arriver DROP controleurs_id');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279B3B430C5');
        $this->addSql('DROP INDEX UNIQ_59C3C279B3B430C5 ON fiche_de_controle');
        $this->addSql('ALTER TABLE fiche_de_controle DROP courrier_arriver_id, CHANGE nom_controleur nom_controleur VARCHAR(255) NOT NULL');
    }
}
