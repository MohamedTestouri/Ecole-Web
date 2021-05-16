<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210509125127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, annonce_name VARCHAR(255) NOT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, picture VARCHAR(1000) NOT NULL, description VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cat_event (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, color VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_publicity (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, formations_id INT NOT NULL, parent_id INT DEFAULT NULL, content LONGTEXT NOT NULL, active TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, rgbd TINYINT(1) NOT NULL, INDEX IDX_5F9E962A3BF5B0C2 (formations_id), INDEX IDX_5F9E962A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, cat_event_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(250) NOT NULL, image VARCHAR(150) NOT NULL, datedeb DATE NOT NULL, datefin DATE NOT NULL, INDEX IDX_B26681EF3DFADC8 (cat_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(191) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(191) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(191) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, prix INT NOT NULL, id_user INT NOT NULL, id_formation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participate (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, events_id INT DEFAULT NULL, dateparticipate DATE DEFAULT NULL, INDEX IDX_D02B13867B3B43D (users_id), INDEX IDX_D02B1389D6A1065 (events_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, id_formation_id INT NOT NULL, id_client INT NOT NULL, INDEX IDX_AB55E24F71C15D5C (id_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publicite (id INT AUTO_INCREMENT NOT NULL, id_formation_id INT DEFAULT NULL, category_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, code_promo VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_1D394E3971C15D5C (id_formation_id), INDEX IDX_1D394E3912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(220) NOT NULL, question_a VARCHAR(250) NOT NULL, reponse VARCHAR(250) NOT NULL, fausse_reponse VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, nom_quiz VARCHAR(255) NOT NULL, INDEX IDX_A412FA925200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qusetion_quiz (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, quiz_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_960FE85A1E27F6BF (question_id), UNIQUE INDEX UNIQ_960FE85A853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, date_reclamation DATE NOT NULL, etat VARCHAR(255) NOT NULL, id_client INT NOT NULL, INDEX IDX_CE606404BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, reponse_1 VARCHAR(250) NOT NULL, reponse_2 VARCHAR(250) NOT NULL, reponse_3 VARCHAR(250) NOT NULL, UNIQUE INDEX UNIQ_5FB6DEC71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tablecours (id INT AUTO_INCREMENT NOT NULL, image_c VARCHAR(255) NOT NULL, filename_pdf VARCHAR(255) NOT NULL, filename_video VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tableformations (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tableformations_tablecours (tableformations_id INT NOT NULL, tablecours_id INT NOT NULL, INDEX IDX_4FBEA729D44D43A9 (tableformations_id), INDEX IDX_4FBEA7298B4D8C2 (tablecours_id), PRIMARY KEY(tableformations_id, tablecours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, tag_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, state TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_cours (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, formation_id INT DEFAULT NULL, INDEX IDX_DF26959ABAD26311 (tag_id), INDEX IDX_DF26959A5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement (id INT AUTO_INCREMENT NOT NULL, id_reclamation_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_2A356D27100D1FDF (id_reclamation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, datedenaissance DATE NOT NULL, telephone VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, wallet INT NOT NULL, fidality INT NOT NULL, etat INT NOT NULL, datedecreation DATETIME NOT NULL, activation VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES tableformations (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A727ACA70 FOREIGN KEY (parent_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF3DFADC8 FOREIGN KEY (cat_event_id) REFERENCES cat_event (id)');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B13867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE participate ADD CONSTRAINT FK_D02B1389D6A1065 FOREIGN KEY (events_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F71C15D5C FOREIGN KEY (id_formation_id) REFERENCES tableformations (id)');
        $this->addSql('ALTER TABLE publicite ADD CONSTRAINT FK_1D394E3971C15D5C FOREIGN KEY (id_formation_id) REFERENCES tableformations (id)');
        $this->addSql('ALTER TABLE publicite ADD CONSTRAINT FK_1D394E3912469DE2 FOREIGN KEY (category_id) REFERENCES category_publicity (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA925200282E FOREIGN KEY (formation_id) REFERENCES tableformations (id)');
        $this->addSql('ALTER TABLE qusetion_quiz ADD CONSTRAINT FK_960FE85A1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE qusetion_quiz ADD CONSTRAINT FK_960FE85A853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE tableformations_tablecours ADD CONSTRAINT FK_4FBEA729D44D43A9 FOREIGN KEY (tableformations_id) REFERENCES tableformations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tableformations_tablecours ADD CONSTRAINT FK_4FBEA7298B4D8C2 FOREIGN KEY (tablecours_id) REFERENCES tablecours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_cours ADD CONSTRAINT FK_DF26959ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE tag_cours ADD CONSTRAINT FK_DF26959A5200282E FOREIGN KEY (formation_id) REFERENCES tableformations (id)');
        $this->addSql('ALTER TABLE traitement ADD CONSTRAINT FK_2A356D27100D1FDF FOREIGN KEY (id_reclamation_id) REFERENCES reclamation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EF3DFADC8');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404BCF5E72D');
        $this->addSql('ALTER TABLE publicite DROP FOREIGN KEY FK_1D394E3912469DE2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A727ACA70');
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B1389D6A1065');
        $this->addSql('ALTER TABLE qusetion_quiz DROP FOREIGN KEY FK_960FE85A1E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE qusetion_quiz DROP FOREIGN KEY FK_960FE85A853CD175');
        $this->addSql('ALTER TABLE traitement DROP FOREIGN KEY FK_2A356D27100D1FDF');
        $this->addSql('ALTER TABLE tableformations_tablecours DROP FOREIGN KEY FK_4FBEA7298B4D8C2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A3BF5B0C2');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F71C15D5C');
        $this->addSql('ALTER TABLE publicite DROP FOREIGN KEY FK_1D394E3971C15D5C');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA925200282E');
        $this->addSql('ALTER TABLE tableformations_tablecours DROP FOREIGN KEY FK_4FBEA729D44D43A9');
        $this->addSql('ALTER TABLE tag_cours DROP FOREIGN KEY FK_DF26959A5200282E');
        $this->addSql('ALTER TABLE tag_cours DROP FOREIGN KEY FK_DF26959ABAD26311');
        $this->addSql('ALTER TABLE participate DROP FOREIGN KEY FK_D02B13867B3B43D');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE cat_event');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE category_publicity');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE participate');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE publicite');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE qusetion_quiz');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE tablecours');
        $this->addSql('DROP TABLE tableformations');
        $this->addSql('DROP TABLE tableformations_tablecours');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_cours');
        $this->addSql('DROP TABLE traitement');
        $this->addSql('DROP TABLE users');
    }
}
