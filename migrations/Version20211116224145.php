<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116224145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C21710560508');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2177EB2C349');
        $this->addSql('DROP INDEX IDX_DD05C2177EB2C349 ON tema_foro');
        $this->addSql('DROP INDEX IDX_DD05C21710560508 ON tema_foro');
        $this->addSql('ALTER TABLE tema_foro ADD usuario_id INT NOT NULL, ADD categoria_id INT NOT NULL, DROP id_usuario_id, DROP id_categoria_id');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C217DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2173397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_DD05C217DB38439E ON tema_foro (usuario_id)');
        $this->addSql('CREATE INDEX IDX_DD05C2173397707A ON tema_foro (categoria_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C217DB38439E');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2173397707A');
        $this->addSql('DROP INDEX IDX_DD05C217DB38439E ON tema_foro');
        $this->addSql('DROP INDEX IDX_DD05C2173397707A ON tema_foro');
        $this->addSql('ALTER TABLE tema_foro ADD id_usuario_id INT NOT NULL, ADD id_categoria_id INT NOT NULL, DROP usuario_id, DROP categoria_id');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C21710560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2177EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_DD05C2177EB2C349 ON tema_foro (id_usuario_id)');
        $this->addSql('CREATE INDEX IDX_DD05C21710560508 ON tema_foro (id_categoria_id)');
    }
}
