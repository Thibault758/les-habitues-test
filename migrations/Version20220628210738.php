<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628210738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lh_localisation (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(20) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, team TINYINT(1) NOT NULL, geographic_coordinate_lat DOUBLE PRECISION NOT NULL, geographic_coordinate_lng DOUBLE PRECISION NOT NULL, INDEX IDX_8560945B4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lh_localisation_prepayment (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, amount INT DEFAULT NULL, INDEX IDX_14F57B804D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lh_offer (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, reduction DOUBLE PRECISION DEFAULT NULL, INDEX IDX_4813A21E4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lh_shop (id INT AUTO_INCREMENT NOT NULL, id_api INT NOT NULL, chain VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, category_id INT DEFAULT NULL, ecommerce_prepayment TINYINT(1) NOT NULL, total_supplier_users INT DEFAULT NULL, total_offers INT DEFAULT NULL, publication TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, wallets_total INT DEFAULT NULL, picture_url VARCHAR(255) DEFAULT NULL, wallets_last_month INT DEFAULT NULL, pipedrive_deal_id INT DEFAULT NULL, pipedrive_org_id INT DEFAULT NULL, geographic_coordinate_lat DOUBLE PRECISION NOT NULL, geographic_coordinate_lng DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lh_tag (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_810236B4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lh_localisation ADD CONSTRAINT FK_8560945B4D16C4DD FOREIGN KEY (shop_id) REFERENCES lh_shop (id)');
        $this->addSql('ALTER TABLE lh_localisation_prepayment ADD CONSTRAINT FK_14F57B804D16C4DD FOREIGN KEY (shop_id) REFERENCES lh_shop (id)');
        $this->addSql('ALTER TABLE lh_offer ADD CONSTRAINT FK_4813A21E4D16C4DD FOREIGN KEY (shop_id) REFERENCES lh_shop (id)');
        $this->addSql('ALTER TABLE lh_tag ADD CONSTRAINT FK_810236B4D16C4DD FOREIGN KEY (shop_id) REFERENCES lh_shop (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lh_localisation DROP FOREIGN KEY FK_8560945B4D16C4DD');
        $this->addSql('ALTER TABLE lh_localisation_prepayment DROP FOREIGN KEY FK_14F57B804D16C4DD');
        $this->addSql('ALTER TABLE lh_offer DROP FOREIGN KEY FK_4813A21E4D16C4DD');
        $this->addSql('ALTER TABLE lh_tag DROP FOREIGN KEY FK_810236B4D16C4DD');
        $this->addSql('DROP TABLE lh_localisation');
        $this->addSql('DROP TABLE lh_localisation_prepayment');
        $this->addSql('DROP TABLE lh_offer');
        $this->addSql('DROP TABLE lh_shop');
        $this->addSql('DROP TABLE lh_tag');
    }
}
