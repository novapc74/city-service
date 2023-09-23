<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230923140833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2AA1F2DB6');
        $this->addSql('DROP INDEX IDX_E19D9AD2AA1F2DB6 ON service');
        $this->addSql('ALTER TABLE service DROP parent_service_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD parent_service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2AA1F2DB6 FOREIGN KEY (parent_service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2AA1F2DB6 ON service (parent_service_id)');
    }
}
