<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921063221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE work_category (id INT AUTO_INCREMENT NOT NULL, work_category_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_D3F9939DD877D21 (work_category_id), INDEX IDX_D3F9939D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_category ADD CONSTRAINT FK_D3F9939DD877D21 FOREIGN KEY (work_category_id) REFERENCES work_category (id)');
        $this->addSql('ALTER TABLE work_category ADD CONSTRAINT FK_D3F9939D12469DE2 FOREIGN KEY (category_id) REFERENCES work_category (id)');
        $this->addSql('ALTER TABLE gallery ADD work_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AD877D21 FOREIGN KEY (work_category_id) REFERENCES work_category (id)');
        $this->addSql('CREATE INDEX IDX_472B783AD877D21 ON gallery (work_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AD877D21');
        $this->addSql('ALTER TABLE work_category DROP FOREIGN KEY FK_D3F9939DD877D21');
        $this->addSql('ALTER TABLE work_category DROP FOREIGN KEY FK_D3F9939D12469DE2');
        $this->addSql('DROP TABLE work_category');
        $this->addSql('DROP INDEX IDX_472B783AD877D21 ON gallery');
        $this->addSql('ALTER TABLE gallery DROP work_category_id');
    }
}
