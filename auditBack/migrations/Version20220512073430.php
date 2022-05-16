<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512073430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistante (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controleurs (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordinateur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier (id INT AUTO_INCREMENT NOT NULL, rapport_id INT DEFAULT NULL, assistante_id INT DEFAULT NULL, coordinateur_id INT DEFAULT NULL, numero_courier VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_CF134C7C1DFBCC46 (rapport_id), INDEX IDX_CF134C7CA2561908 (assistante_id), INDEX IDX_CF134C7CD32E46EA (coordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_controleurs (courier_id INT NOT NULL, controleurs_id INT NOT NULL, INDEX IDX_62FEA81CE3D8151C (courier_id), INDEX IDX_62FEA81C90C7B3D2 (controleurs_id), PRIMARY KEY(courier_id, controleurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_arriver (id INT NOT NULL, date_arriver VARCHAR(255) DEFAULT NULL, expediteur VARCHAR(255) DEFAULT NULL, date_correspondance VARCHAR(255) DEFAULT NULL, numero_correspondance VARCHAR(255) DEFAULT NULL, date_reponse VARCHAR(255) DEFAULT NULL, numero_reponse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_depart (id INT NOT NULL, date_depart VARCHAR(255) DEFAULT NULL, destination VARCHAR(255) DEFAULT NULL, nombre_piece VARCHAR(255) NOT NULL, numero_archive VARCHAR(255) DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, numero_ordre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, courier_depart_id INT DEFAULT NULL, courier_arriver_id INT DEFAULT NULL, numero_facture VARCHAR(255) NOT NULL, montant VARCHAR(255) DEFAULT NULL, object VARCHAR(255) DEFAULT NULL, beneficaire VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_FE866410FF2C13F9 (courier_depart_id), UNIQUE INDEX UNIQ_FE866410200ED29 (courier_arriver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_controle (id INT AUTO_INCREMENT NOT NULL, controleurs_id INT DEFAULT NULL, coordinateur_id INT DEFAULT NULL, nom_controleur VARCHAR(255) NOT NULL, avis_controleur VARCHAR(255) DEFAULT NULL, motivation VARCHAR(255) DEFAULT NULL, recommandations VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, INDEX IDX_59C3C27990C7B3D2 (controleurs_id), INDEX IDX_59C3C279D32E46EA (coordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, coordinateur_id INT DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, INDEX IDX_BE34A09CD32E46EA (coordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, matricule VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_de_naissance VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistante ADD CONSTRAINT FK_1ECC0164BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controleurs ADD CONSTRAINT FK_6AB6ABCDBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coordinateur ADD CONSTRAINT FK_83AD9AC4BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7C1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CA2561908 FOREIGN KEY (assistante_id) REFERENCES assistante (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81CE3D8151C FOREIGN KEY (courier_id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_controleurs ADD CONSTRAINT FK_62FEA81C90C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD143BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_depart ADD CONSTRAINT FK_B8313FC1BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410FF2C13F9 FOREIGN KEY (courier_depart_id) REFERENCES courier_depart (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410200ED29 FOREIGN KEY (courier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C27990C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279D32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CA2561908');
        $this->addSql('ALTER TABLE courier_controleurs DROP FOREIGN KEY FK_62FEA81C90C7B3D2');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C27990C7B3D2');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CD32E46EA');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279D32E46EA');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CD32E46EA');
        $this->addSql('ALTER TABLE courier_controleurs DROP FOREIGN KEY FK_62FEA81CE3D8151C');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD143BF396750');
        $this->addSql('ALTER TABLE courier_depart DROP FOREIGN KEY FK_B8313FC1BF396750');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410200ED29');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410FF2C13F9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7C1DFBCC46');
        $this->addSql('ALTER TABLE assistante DROP FOREIGN KEY FK_1ECC0164BF396750');
        $this->addSql('ALTER TABLE controleurs DROP FOREIGN KEY FK_6AB6ABCDBF396750');
        $this->addSql('ALTER TABLE coordinateur DROP FOREIGN KEY FK_83AD9AC4BF396750');
        $this->addSql('DROP TABLE assistante');
        $this->addSql('DROP TABLE controleurs');
        $this->addSql('DROP TABLE coordinateur');
        $this->addSql('DROP TABLE courier');
        $this->addSql('DROP TABLE courier_controleurs');
        $this->addSql('DROP TABLE courier_arriver');
        $this->addSql('DROP TABLE courier_depart');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fiche_de_controle');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE user');
    }
}
