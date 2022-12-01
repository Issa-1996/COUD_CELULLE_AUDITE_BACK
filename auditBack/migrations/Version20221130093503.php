<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130093503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistante (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controleur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonateur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier (id INT AUTO_INCREMENT NOT NULL, assistante_id INT DEFAULT NULL, coordonateur_id INT DEFAULT NULL, controleur_id INT DEFAULT NULL, numero_courier VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, numero_facture VARCHAR(255) NOT NULL, montant VARCHAR(255) DEFAULT NULL, destinataire VARCHAR(255) DEFAULT NULL, numero_compte VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_CF134C7CA2561908 (assistante_id), INDEX IDX_CF134C7CDE3036AD (coordonateur_id), INDEX IDX_CF134C7CB13E6101 (controleur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_arriver (id INT NOT NULL, expediteur VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, type_de_courrier VARCHAR(255) DEFAULT NULL, date_arriver VARCHAR(255) NOT NULL, numero_arriver VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_279DD1433D2BA72 (numero_arriver), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courier_depart (id INT NOT NULL, observation VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, date_depart VARCHAR(255) NOT NULL, numero_depart VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B8313FC143F9A832 (numero_depart), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_controle (id INT AUTO_INCREMENT NOT NULL, controleur_id INT DEFAULT NULL, coordonateur_id INT DEFAULT NULL, courrier_arriver_id INT DEFAULT NULL, nom_controleur VARCHAR(255) DEFAULT NULL, avis_controleur VARCHAR(255) DEFAULT NULL, motivation VARCHAR(255) DEFAULT NULL, recommandations VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, INDEX IDX_59C3C279B13E6101 (controleur_id), INDEX IDX_59C3C279DE3036AD (coordonateur_id), UNIQUE INDEX UNIQ_59C3C279B3B430C5 (courrier_arriver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, matricule VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_ajout VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64912B2DC9C (matricule), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistante ADD CONSTRAINT FK_1ECC0164BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controleur ADD CONSTRAINT FK_9E14F44BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coordonateur ADD CONSTRAINT FK_E07DAFFEBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CA2561908 FOREIGN KEY (assistante_id) REFERENCES assistante (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CDE3036AD FOREIGN KEY (coordonateur_id) REFERENCES coordonateur (id)');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CB13E6101 FOREIGN KEY (controleur_id) REFERENCES controleur (id)');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD143BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courier_depart ADD CONSTRAINT FK_B8313FC1BF396750 FOREIGN KEY (id) REFERENCES courier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279B13E6101 FOREIGN KEY (controleur_id) REFERENCES controleur (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279DE3036AD FOREIGN KEY (coordonateur_id) REFERENCES coordonateur (id)');
        $this->addSql('ALTER TABLE fiche_de_controle ADD CONSTRAINT FK_59C3C279B3B430C5 FOREIGN KEY (courrier_arriver_id) REFERENCES courier_arriver (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CA2561908');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CB13E6101');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279B13E6101');
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CDE3036AD');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279DE3036AD');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD143BF396750');
        $this->addSql('ALTER TABLE courier_depart DROP FOREIGN KEY FK_B8313FC1BF396750');
        $this->addSql('ALTER TABLE fiche_de_controle DROP FOREIGN KEY FK_59C3C279B3B430C5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('ALTER TABLE assistante DROP FOREIGN KEY FK_1ECC0164BF396750');
        $this->addSql('ALTER TABLE controleur DROP FOREIGN KEY FK_9E14F44BF396750');
        $this->addSql('ALTER TABLE coordonateur DROP FOREIGN KEY FK_E07DAFFEBF396750');
        $this->addSql('DROP TABLE assistante');
        $this->addSql('DROP TABLE controleur');
        $this->addSql('DROP TABLE coordonateur');
        $this->addSql('DROP TABLE courier');
        $this->addSql('DROP TABLE courier_arriver');
        $this->addSql('DROP TABLE courier_depart');
        $this->addSql('DROP TABLE fiche_de_controle');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE user');
    }
}
