<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627151005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'asdoria_marketing_cart';
    }

    public function up(Schema $schema): void
    {
        if($schema->hasTable('asdoria_marketing_cart'))return;
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asdoria_marketing_cart (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, archived_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, highlighted TINYINT(1) NOT NULL, position INT NOT NULL, facet_filter_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_channel (marketingcart_id INT NOT NULL, channelinterface_id INT NOT NULL, INDEX IDX_7A9CA0B6DF80FC13 (marketingcart_id), INDEX IDX_7A9CA0B6EC6CA45D (channelinterface_id), PRIMARY KEY(marketingcart_id, channelinterface_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_taxon (marketingcart_id INT NOT NULL, taxoninterface_id INT NOT NULL, INDEX IDX_83FF7379DF80FC13 (marketingcart_id), INDEX IDX_83FF73797E2DD0E0 (taxoninterface_id), PRIMARY KEY(marketingcart_id, taxoninterface_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_attribute_value (id INT AUTO_INCREMENT NOT NULL, marketing_cart_id INT DEFAULT NULL, attribute_id INT DEFAULT NULL, locale_code VARCHAR(255) DEFAULT NULL, text_value LONGTEXT DEFAULT NULL, boolean_value TINYINT(1) DEFAULT NULL, integer_value INT DEFAULT NULL, float_value DOUBLE PRECISION DEFAULT NULL, datetime_value DATETIME DEFAULT NULL, date_value DATE DEFAULT NULL, json_value LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_B3B047E6B1389630 (marketing_cart_id), INDEX IDX_B3B047E6B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_1DA5548D7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_similar (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, marketingCart_id INT DEFAULT NULL, similarCart_id INT DEFAULT NULL, INDEX IDX_13DE166C103DC58F (marketingCart_id), INDEX IDX_13DE166C7505361D (similarCart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_marketing_cart_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, metaTitle VARCHAR(255) DEFAULT NULL, metaKeywords VARCHAR(1000) DEFAULT NULL, metaDescription VARCHAR(1000) DEFAULT NULL, metaRobots VARCHAR(255) DEFAULT NULL, metaCanonical VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_28E29A432C2AC5D3 (translatable_id), UNIQUE INDEX slug_uidx (locale, slug), UNIQUE INDEX asdoria_marketing_cart_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_channel ADD CONSTRAINT FK_7A9CA0B6DF80FC13 FOREIGN KEY (marketingcart_id) REFERENCES asdoria_marketing_cart (id)');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_channel ADD CONSTRAINT FK_7A9CA0B6EC6CA45D FOREIGN KEY (channelinterface_id) REFERENCES sylius_channel (id)');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_taxon ADD CONSTRAINT FK_83FF7379DF80FC13 FOREIGN KEY (marketingcart_id) REFERENCES asdoria_marketing_cart (id)');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_taxon ADD CONSTRAINT FK_83FF73797E2DD0E0 FOREIGN KEY (taxoninterface_id) REFERENCES sylius_taxon (id)');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_attribute_value ADD CONSTRAINT FK_B3B047E6B1389630 FOREIGN KEY (marketing_cart_id) REFERENCES asdoria_marketing_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_attribute_value ADD CONSTRAINT FK_B3B047E6B6E62EFA FOREIGN KEY (attribute_id) REFERENCES sylius_product_attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_image ADD CONSTRAINT FK_1DA5548D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES asdoria_marketing_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_similar ADD CONSTRAINT FK_13DE166C103DC58F FOREIGN KEY (marketingCart_id) REFERENCES asdoria_marketing_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_similar ADD CONSTRAINT FK_13DE166C7505361D FOREIGN KEY (similarCart_id) REFERENCES asdoria_marketing_cart (id)');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_translation ADD CONSTRAINT FK_28E29A432C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES asdoria_marketing_cart (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_marketing_cart_channel DROP FOREIGN KEY FK_7A9CA0B6DF80FC13');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_taxon DROP FOREIGN KEY FK_83FF7379DF80FC13');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_attribute_value DROP FOREIGN KEY FK_B3B047E6B1389630');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_image DROP FOREIGN KEY FK_1DA5548D7E3C61F9');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_similar DROP FOREIGN KEY FK_13DE166C103DC58F');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_similar DROP FOREIGN KEY FK_13DE166C7505361D');
        $this->addSql('ALTER TABLE asdoria_marketing_cart_translation DROP FOREIGN KEY FK_28E29A432C2AC5D3');
        $this->addSql('DROP TABLE asdoria_marketing_cart');
        $this->addSql('DROP TABLE asdoria_marketing_cart_channel');
        $this->addSql('DROP TABLE asdoria_marketing_cart_taxon');
        $this->addSql('DROP TABLE asdoria_marketing_cart_attribute_value');
        $this->addSql('DROP TABLE asdoria_marketing_cart_image');
        $this->addSql('DROP TABLE asdoria_marketing_cart_similar');
        $this->addSql('DROP TABLE asdoria_marketing_cart_translation');
    }
}
