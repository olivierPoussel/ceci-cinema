<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114111026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, realisateur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, duree INT NOT NULL, INDEX IDX_8244BE22F1D8422E (realisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (film_id INT NOT NULL, acteur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_57698A6A567F5183 (film_id), INDEX IDX_57698A6ADA6F574A (acteur_id), PRIMARY KEY(film_id, acteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (date_seance DATETIME NOT NULL, film_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_DF7DFD0E567F5183 (film_id), INDEX IDX_DF7DFD0EDC304035 (salle_id), PRIMARY KEY(date_seance, film_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22F1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6ADA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6ADA6F574A');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A567F5183');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E567F5183');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22F1D8422E');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EDC304035');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE realisateur');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE seance');
    }
}
