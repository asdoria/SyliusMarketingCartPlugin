<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628150852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if($schema->getTable('asdoria_marketing_cart')->hasColumn('and_where_attribute'))return;
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_marketing_cart ADD and_where_attribute TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_marketing_cart DROP and_where_attribute');
    }
}
