<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426130018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistante ADD CONSTRAINT FK_1ECC0164BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controleurs ADD CONSTRAINT FK_6AB6ABCDBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coordinateur ADD CONSTRAINT FK_83AD9AC4BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7C1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CA2561908 FOREIGN KEY (assistante_id) REFERENCES assistante (id)');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81CE3D8151C FOREIGN KEY (courier_id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81C90C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD143BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_depart ADD CONSTRAINT FK_B8313FC1BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410FF2C13F9 FOREIGN KEY (courier_depart_id) REFERENCES courier_depart (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410200ED29 FOREIGN KEY (courier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C27990C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279D32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE user ADD matricule VARCHAR(255) DEFAULT NULL, ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD date_de_naissance VARCHAR(255) DEFAULT NULL, ADD profil VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD dtype VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistante DROP FOREIGN KEY FK_1ECC0164BF396750');
        $this->addSql('ALTER TABLE controleurs DROP FOREIGN KEY FK_6AB6ABCDBF396750');
        $this->addSql('ALTER TABLE coordinateur DROP FOREIGN KEY FK_83AD9AC4BF396750');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7C1DFBCC46');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CA2561908');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD143BF396750');
        $this->addSql('ALTER TABLE courier_controleurs DROP FOREIGN KEY FK_62FEA81CE3D8151C');
        $this->addSql('ALTER TABLE courier_controleurs DROP FOREIGN KEY FK_62FEA81C90C7B3D2');
        $this->addSql('ALTER TABLE courier_depart DROP FOREIGN KEY FK_B8313FC1BF396750');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410FF2C13F9');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410200ED29');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C27990C7B3D2');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279D32E46EA');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CD32E46EA');
        $this->addSql('ALTER TABLE user DROP matricule, DROP nom, DROP prenom, DROP date_de_naissance, DROP profil, DROP email, DROP dtype');
    }
}
