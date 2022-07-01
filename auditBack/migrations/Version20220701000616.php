<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701000616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier DROP FOREIGN KEY FK_CF134C7CB13E6101');
        $this->addSql('DROP INDEX IDX_CF134C7CB13E6101 ON courier');
        $this->addSql('ALTER TABLE courier DROP controleur_id');
        $this->addSql('ALTER TABLE courier_arriver ADD controleurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier_arriver ADD CONSTRAINT FK_279DD14390C7B3D2 FOREIGN KEY (controleurs_id) REFERENCES controleurs (id)');
        $this->addSql('CREATE INDEX IDX_279DD14390C7B3D2 ON courier_arriver (controleurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courier ADD controleur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courier ADD CONSTRAINT FK_CF134C7CB13E6101 FOREIGN KEY (controleur_id) REFERENCES controleurs (id)');
        $this->addSql('CREATE INDEX IDX_CF134C7CB13E6101 ON courier (controleur_id)');
        $this->addSql('ALTER TABLE courier_arriver DROP FOREIGN KEY FK_279DD14390C7B3D2');
        $this->addSql('DROP INDEX IDX_279DD14390C7B3D2 ON courier_arriver');
        $this->addSql('ALTER TABLE courier_arriver DROP controleurs_id');
    }
}
