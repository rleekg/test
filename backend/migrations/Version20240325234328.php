<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\UuidV7;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325234328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, tax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE product (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');

        $this->addSql("INSERT INTO country VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1cfe9d87'), 'Германии', 'DE', 19)");
        $this->addSql("INSERT INTO country VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1df2cda8'), 'Италии', 'IT', 22)");
        $this->addSql("INSERT INTO country VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1dfc0885'), 'Франции', 'GR', 20)");
        $this->addSql("INSERT INTO country VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1e35d1e0'), 'Греции', 'FR', 24)");

        $this->addSql("INSERT INTO product VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1f0f110d'), 'Iphone', 100000)");
        $this->addSql("INSERT INTO product VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f1fe1f69c'), 'Наушники', 20000)");
        $this->addSql("INSERT INTO product VALUES (UUID_TO_BIN('018e7808-14b9-7c07-8a74-e02f2084bd81'), 'Чехол', 10000)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE product');
    }
}
