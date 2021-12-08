<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208134909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission_villain (mission_id INT NOT NULL, villain_id INT NOT NULL, INDEX IDX_D6011FE1BE6CAE90 (mission_id), INDEX IDX_D6011FE1363C6CE2 (villain_id), PRIMARY KEY(mission_id, villain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission_villain ADD CONSTRAINT FK_D6011FE1BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_villain ADD CONSTRAINT FK_D6011FE1363C6CE2 FOREIGN KEY (villain_id) REFERENCES villain (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE superhero');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE superhero (id INT AUTO_INCREMENT NOT NULL, mission_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8C5E38BDBE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE superhero ADD CONSTRAINT FK_8C5E38BDBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('DROP TABLE mission_villain');
    }
}
