<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630114700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CC6C0B070');
        $this->addSql('DROP INDEX UNIQ_CF134C7CC6C0B070 ON courier');
        $this->addSql('ALTER TABLE courier DROP fiche_de_controle_id');
        $this->addSql('ALTER TABLE fiche_de_controle ADD courrier_arriver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279B3B430C5 FOREIGN KEY (courrier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59C3C279B3B430C5 ON fiche_de_controle (courrier_arriver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier ADD fiche_de_controle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CC6C0B070 FOREIGN KEY (fiche_de_controle_id) REFERENCES fiche_de_controle (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF134C7CC6C0B070 ON courier (fiche_de_controle_id)');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279B3B430C5');
        $this->addSql('DROP INDEX UNIQ_59C3C279B3B430C5 ON fiche_de_controle');
        $this->addSql('ALTER TABLE fiche_de_controle DROP courrier_arriver_id');
    }
}
