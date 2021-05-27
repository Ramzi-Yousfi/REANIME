<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527143227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home (id INT AUTO_INCREMENT NOT NULL, section1_image VARCHAR(255) NOT NULL, section1_text LONGTEXT NOT NULL, section2text1 LONGTEXT NOT NULL, section2_text2 LONGTEXT NOT NULL, section1_titre VARCHAR(255) NOT NULL, section2_titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE anime ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C7794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_genre ADD CONSTRAINT FK_EFF953C74296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_episode ADD CONSTRAINT FK_C8C63B17794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_episode ADD CONSTRAINT FK_C8C63B17362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE home');
        $this->addSql('DROP TABLE reset_password');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE anime DROP created_at');
        $this->addSql('ALTER TABLE anime_episode DROP FOREIGN KEY FK_C8C63B17794BBE89');
        $this->addSql('ALTER TABLE anime_episode DROP FOREIGN KEY FK_C8C63B17362B62A0');
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C7794BBE89');
        $this->addSql('ALTER TABLE anime_genre DROP FOREIGN KEY FK_EFF953C74296D31F');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4584665A');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
