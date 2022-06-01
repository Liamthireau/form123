<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601132105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collectivite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, mail VARCHAR(100) DEFAULT NULL, siren INT NOT NULL, nic INT NOT NULL, update_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, etat_id INT DEFAULT NULL, collectivite_id INT DEFAULT NULL, uid VARCHAR(60) DEFAULT NULL, prenom VARCHAR(100) NOT NULL, nom VARCHAR(100) NOT NULL, mail VARCHAR(255) NOT NULL, referent TINYINT(1) NOT NULL, update_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', create_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CFF65260D5E86FF (etat_id), INDEX IDX_CFF65260A7991F51 (collectivite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_extranet (compte_id INT NOT NULL, extranet_id INT NOT NULL, INDEX IDX_3D8EDCF4F2C56620 (compte_id), INDEX IDX_3D8EDCF4DF10B061 (extranet_id), PRIMARY KEY(compte_id, extranet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE extranet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A7991F51 FOREIGN KEY (collectivite_id) REFERENCES collectivite (id)');
        $this->addSql('ALTER TABLE compte_extranet ADD CONSTRAINT FK_3D8EDCF4F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte_extranet ADD CONSTRAINT FK_3D8EDCF4DF10B061 FOREIGN KEY (extranet_id) REFERENCES extranet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260A7991F51');
        $this->addSql('ALTER TABLE compte_extranet DROP FOREIGN KEY FK_3D8EDCF4F2C56620');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260D5E86FF');
        $this->addSql('ALTER TABLE compte_extranet DROP FOREIGN KEY FK_3D8EDCF4DF10B061');
        $this->addSql('DROP TABLE collectivite');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE compte_extranet');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE extranet');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
