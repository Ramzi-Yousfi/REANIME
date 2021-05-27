<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527142745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, postal_address VARCHAR(255) NOT NULL, postal VARCHAR(150) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, illustration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_published TINYINT(1) NOT NULL, is_delete TINYINT(1) DEFAULT NULL, INDEX IDX_5F9E962A4584665A (product_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home (id INT AUTO_INCREMENT NOT NULL, section1_image VARCHAR(255) NOT NULL, section1_text LONGTEXT NOT NULL, section2text1 LONGTEXT NOT NULL, section2_text2 LONGTEXT NOT NULL, section1_titre VARCHAR(255) NOT NULL, section2_titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, carrier_name VARCHAR(255) NOT NULL, carrier_price DOUBLE PRECISION NOT NULL, delivery LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_paid TINYINT(1) NOT NULL, reference VARCHAR(255) NOT NULL, carrier_illustration VARCHAR(255) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, my_order_id INT NOT NULL, product VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_845CA2C1BFCDF877 (my_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE anime ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE episode CHANGE number number VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE product ADD is_new TINYINT(1) DEFAULT NULL, ADD stock INT DEFAULT NULL, ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD month INT NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE home');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE reset_password');
        $this->addSql('ALTER TABLE anime DROP created_at');
        $this->addSql('ALTER TABLE episode CHANGE number number INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP is_new, DROP stock, DROP created_at');
        $this->addSql('ALTER TABLE `user` DROP month, DROP avatar, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
