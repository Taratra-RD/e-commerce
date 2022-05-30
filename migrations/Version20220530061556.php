<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530061556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE search ADD max_rooms INT DEFAULT NULL, ADD min_bed_room INT DEFAULT NULL, DROP search_title, DROP max_price, DROP min_floor_number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE search ADD search_title VARCHAR(255) DEFAULT \'\' NOT NULL, ADD max_price INT DEFAULT NULL, ADD min_floor_number INT DEFAULT NULL, DROP max_rooms, DROP min_bed_room');
    }
}
