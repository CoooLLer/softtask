<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200412151258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE product_properties (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, width SMALLINT DEFAULT NULL, height SMALLINT DEFAULT NULL, cord_type VARCHAR(1) DEFAULT NULL, diameter SMALLINT DEFAULT NULL, load_index SMALLINT DEFAULT NULL, speed_symbol VARCHAR(3) DEFAULT NULL, designates VARCHAR(255) DEFAULT NULL, runflat_abbreviation VARCHAR(20) DEFAULT NULL, tube_type VARCHAR(20) DEFAULT NULL, season VARCHAR(20) DEFAULT NULL)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, properties_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, is_correct_title BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD3691D1CA ON product (properties_id)');
        $this->addSql('CREATE TABLE product_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE product_properties');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
    }
}
