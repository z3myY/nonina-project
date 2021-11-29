<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129203507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE likes_noticia');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE likes_noticia (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_noticia_id INT NOT NULL, UNIQUE INDEX UNIQ_839933647EB2C349 (id_usuario_id), UNIQUE INDEX UNIQ_839933643C18E0C7 (id_noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933647EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933643C18E0C7 FOREIGN KEY (id_noticia_id) REFERENCES noticia (id)');
    }
}
