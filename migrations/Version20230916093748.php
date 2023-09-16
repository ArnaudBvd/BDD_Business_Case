<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230916093748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, nft_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, buy_date DATE NOT NULL, INDEX IDX_472B783A7E3C61F9 (owner_id), INDEX IDX_472B783AE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A7E3C61F9');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783AE813668D');
        $this->addSql('DROP TABLE gallery');
    }
}
