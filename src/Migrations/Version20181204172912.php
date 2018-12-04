<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204172912 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gestionnaire (id INT AUTO_INCREMENT NOT NULL, localisation_id INT NOT NULL, code_gest VARCHAR(40) NOT NULL, nom_gest VARCHAR(255) NOT NULL, tel_gest INT NOT NULL, email_gest VARCHAR(200) NOT NULL, infos_complement LONGTEXT NOT NULL, type_gest VARCHAR(150) NOT NULL, date_ins_gest DATETIME NOT NULL, INDEX IDX_F4461B20C68BE09C (localisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_etude (id INT AUTO_INCREMENT NOT NULL, niveau VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_identite (id INT AUTO_INCREMENT NOT NULL, nom_piece VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, localisation_id INT NOT NULL, nom_piece_id INT NOT NULL, niveau_id INT NOT NULL, code_prest VARCHAR(50) NOT NULL, nom_prest VARCHAR(100) NOT NULL, prenom_prest VARCHAR(200) NOT NULL, tel_prest INT NOT NULL, email_prest VARCHAR(200) NOT NULL, date_ins_prest DATETIME NOT NULL, num_piece VARCHAR(200) NOT NULL, INDEX IDX_60A26480C68BE09C (localisation_id), INDEX IDX_60A2648051450A21 (nom_piece_id), INDEX IDX_60A26480B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A2648051450A21 FOREIGN KEY (nom_piece_id) REFERENCES piece_identite (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_etude (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gestionnaire DROP FOREIGN KEY FK_F4461B20C68BE09C');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480C68BE09C');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480B3E9C81');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A2648051450A21');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE niveau_etude');
        $this->addSql('DROP TABLE piece_identite');
        $this->addSql('DROP TABLE prestataire');
    }
}
