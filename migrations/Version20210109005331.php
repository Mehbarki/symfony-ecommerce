<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109005331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, buy_at DATETIME NOT NULL, state TINYINT(1) DEFAULT NULL, INDEX IDX_AC6A4CA2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_content (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, quantity INT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_FDF670834D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_content_products (shop_content_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_C050B704FED34ECB (shop_content_id), INDEX IDX_C050B7046C8A81A9 (products_id), PRIMARY KEY(shop_content_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE shop_content ADD CONSTRAINT FK_FDF670834D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE shop_content_products ADD CONSTRAINT FK_C050B704FED34ECB FOREIGN KEY (shop_content_id) REFERENCES shop_content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_content_products ADD CONSTRAINT FK_C050B7046C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_content DROP FOREIGN KEY FK_FDF670834D16C4DD');
        $this->addSql('ALTER TABLE shop_content_products DROP FOREIGN KEY FK_C050B704FED34ECB');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE shop_content');
        $this->addSql('DROP TABLE shop_content_products');
    }
}
