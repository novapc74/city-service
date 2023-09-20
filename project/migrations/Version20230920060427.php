<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920060427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, about_service_id INT DEFAULT NULL, parent_service_id INT DEFAULT NULL, case_service_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, expertise LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', is_active TINYINT(1) NOT NULL, INDEX IDX_E19D9AD22E640580 (about_service_id), INDEX IDX_E19D9AD2AA1F2DB6 (parent_service_id), INDEX IDX_E19D9AD2C71DA102 (case_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD22E640580 FOREIGN KEY (about_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2AA1F2DB6 FOREIGN KEY (parent_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2C71DA102 FOREIGN KEY (case_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE gallery ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_472B783AED5CA9E6 ON gallery (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD22E640580');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2AA1F2DB6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2C71DA102');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP INDEX IDX_472B783AED5CA9E6 ON gallery');
        $this->addSql('ALTER TABLE gallery DROP service_id');
    }
}
