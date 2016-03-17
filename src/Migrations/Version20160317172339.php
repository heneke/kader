<?php

namespace Kader\ORM\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160317172339 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kontaktbeziehungen (kb_id INT AUTO_INCREMENT NOT NULL, kb_parent INT NOT NULL, kb_child INT NOT NULL, kb_typ INT NOT NULL, INDEX IDX_3F827896F320F4A3 (kb_parent), INDEX IDX_3F827896EDC3275E (kb_child), UNIQUE INDEX UNIQ_3F8278965E6D16ECF320F4A3EDC3275E (kb_typ, kb_parent, kb_child), PRIMARY KEY(kb_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kontaktbeziehungen ADD CONSTRAINT FK_3F827896F320F4A3 FOREIGN KEY (kb_parent) REFERENCES kontakte (ko_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kontaktbeziehungen ADD CONSTRAINT FK_3F827896EDC3275E FOREIGN KEY (kb_child) REFERENCES kontakte (ko_id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kontaktbeziehungen');
    }
}
