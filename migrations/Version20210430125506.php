<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430125506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649214C50C0');
        $this->addSql('DROP TABLE profil_image');
        $this->addSql('DROP INDEX IDX_8D93D649214C50C0 ON user');
        $this->addSql('ALTER TABLE user ADD profil_photo VARCHAR(255) DEFAULT NULL, DROP profil_image_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `user` ADD profil_image_id INT DEFAULT NULL, DROP profil_photo');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649214C50C0 FOREIGN KEY (profil_image_id) REFERENCES profil_image (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649214C50C0 ON `user` (profil_image_id)');
    }
}
