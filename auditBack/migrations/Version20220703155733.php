<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703155733 extends AbstractMigration
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
        $this->addSql('CREATE TABLE courier (id INT AUTO_INCREMENT NOT NULL, assistante_id INT DEFAULT NULL, coordinateur_id INT DEFAULT NULL, numero_courier VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, date VARCHAR(255) DEFAULT NULL, numero_facture VARCHAR(255) NOT NULL, montant VARCHAR(255) DEFAULT NULL, beneficiaire VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_CF134C7CA2561908 (assistante_id), INDEX IDX_CF134C7CD32E46EA (coordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_arriver (id INT NOT NULL, controleurs_id INT DEFAULT NULL, expediteur VARCHAR(255) DEFAULT NULL, date_correspondance VARCHAR(255) DEFAULT NULL, numero_correspondance VARCHAR(255) DEFAULT NULL, date_reponse VARCHAR(255) DEFAULT NULL, numero_reponse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_279DD143E3D7B207 (numero_correspondance), UNIQUE INDEX UNIQ_279DD14399E2C066 (numero_reponse), INDEX IDX_279DD14390C7B3D2 (controleurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_depart (id INT NOT NULL, destination VARCHAR(255) DEFAULT NULL, nombre_piece VARCHAR(255) NOT NULL, numero_archive VARCHAR(255) DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, numero_ordre VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B8313FC113A8433D (numero_archive), UNIQUE INDEX UNIQ_B8313FC1DC26B9F4 (numero_ordre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_controle (id INT AUTO_INCREMENT NOT NULL, controleurs_id INT DEFAULT NULL, coordinateur_id INT DEFAULT NULL, courrier_arriver_id INT DEFAULT NULL, nom_controleur VARCHAR(255) DEFAULT NULL, avis_controleur VARCHAR(255) DEFAULT NULL, motivation VARCHAR(255) DEFAULT NULL, recommandations VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, INDEX IDX_59C3C27990C7B3D2 (controleurs_id), INDEX IDX_59C3C279D32E46EA (coordinateur_id), UNIQUE INDEX UNIQ_59C3C279B3B430C5 (courrier_arriver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, matricule VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_de_naissance VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64912B2DC9C (matricule), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistante ADD CONSTRAINT FK_1ECC0164BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controleurs ADD CONSTRAINT FK_6AB6ABCDBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coordinateur ADD CONSTRAINT FK_83AD9AC4BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CA2561908 FOREIGN KEY (assistante_id) REFERENCES assistante (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD14390C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD143BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_depart ADD CONSTRAINT FK_B8313FC1BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C27990C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279D32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279B3B430C5 FOREIGN KEY (courrier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CA2561908');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD14390C7B3D2');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C27990C7B3D2');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CD32E46EA');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279D32E46EA');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD143BF396750');
        $this->addSql('ALTER TABLE courier_depart DROP FOREIGN KEY FK_B8313FC1BF396750');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279B3B430C5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('ALTER TABLE assistante DROP FOREIGN KEY FK_1ECC0164BF396750');
        $this->addSql('ALTER TABLE controleurs DROP FOREIGN KEY FK_6AB6ABCDBF396750');
        $this->addSql('ALTER TABLE coordinateur DROP FOREIGN KEY FK_83AD9AC4BF396750');
        $this->addSql('DROP TABLE assistante');
        $this->addSql('DROP TABLE controleurs');
        $this->addSql('DROP TABLE coordinateur');
        $this->addSql('DROP TABLE courier');
        $this->addSql('DROP TABLE courier_arriver');
        $this->addSql('DROP TABLE courier_depart');
        $this->addSql('DROP TABLE fiche_de_controle');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE user');
    }
}
