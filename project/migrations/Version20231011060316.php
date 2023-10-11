<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011060316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificate ADD preview_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4ACDE46FDB FOREIGN KEY (preview_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_219CDA4ACDE46FDB ON certificate (preview_id)');
//        $this->addSql('ALTER TABLE work_category DROP FOREIGN KEY FK_D3F9939DD877D21');
//        $this->addSql('DROP INDEX IDX_D3F9939DD877D21 ON work_category');
//        $this->addSql('ALTER TABLE work_category DROP work_category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4ACDE46FDB');
        $this->addSql('DROP INDEX IDX_219CDA4ACDE46FDB ON certificate');
        $this->addSql('ALTER TABLE certificate DROP preview_id');
        $this->addSql('ALTER TABLE work_category ADD work_category_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE work_category ADD CONSTRAINT FK_D3F9939DD877D21 FOREIGN KEY (work_category_id) REFERENCES work_category (id)');
//        $this->addSql('CREATE INDEX IDX_D3F9939DD877D21 ON work_category (work_category_id)');
    }
}
