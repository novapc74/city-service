<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230923103426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD727ACA70');
        $this->addSql('DROP INDEX IDX_D34A04AD727ACA70 ON product');
        $this->addSql('ALTER TABLE product DROP parent_id');
        $this->addSql('ALTER TABLE service ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD24584665A ON service (product_id)');
        $this->addSql('ALTER TABLE work_category ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work_category ADD CONSTRAINT FK_D3F9939DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_D3F9939DED5CA9E6 ON work_category (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_category DROP FOREIGN KEY FK_D3F9939DED5CA9E6');
        $this->addSql('DROP INDEX IDX_D3F9939DED5CA9E6 ON work_category');
        $this->addSql('ALTER TABLE work_category DROP service_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD24584665A');
        $this->addSql('DROP INDEX IDX_E19D9AD24584665A ON service');
        $this->addSql('ALTER TABLE service DROP product_id');
        $this->addSql('ALTER TABLE product ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD727ACA70 FOREIGN KEY (parent_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD727ACA70 ON product (parent_id)');
    }
}
