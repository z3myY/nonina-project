<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129202902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE likes_noticia');
        $this->addSql('ALTER TABLE categoria CHANGE nombre_categoria nombre VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7027EB2C349');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7023C18E0C7');
        $this->addSql('DROP INDEX IDX_4B91E7027EB2C349 ON comentario');
        $this->addSql('DROP INDEX IDX_4B91E7023C18E0C7 ON comentario');
        $this->addSql('ALTER TABLE comentario ADD usuario_id INT NOT NULL, ADD noticia_id INT NOT NULL, DROP id_usuario_id, DROP id_noticia_id, CHANGE texto_comentario texto LONGTEXT NOT NULL, CHANGE fecha_comentario fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70299926010 FOREIGN KEY (noticia_id) REFERENCES noticia (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4B91E702DB38439E ON comentario (usuario_id)');
        $this->addSql('CREATE INDEX IDX_4B91E70299926010 ON comentario (noticia_id)');
        $this->addSql('ALTER TABLE likes_comentario MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8D7EB2C349');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8D4DDA0689');
        $this->addSql('DROP INDEX UNIQ_86246F8D7EB2C349 ON likes_comentario');
        $this->addSql('DROP INDEX UNIQ_86246F8D4DDA0689 ON likes_comentario');
        $this->addSql('ALTER TABLE likes_comentario DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE likes_comentario ADD usuario_id INT NOT NULL, ADD comentario_id INT NOT NULL, DROP id, DROP id_usuario_id, DROP id_comentario_id');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8DF3F2D7EC FOREIGN KEY (comentario_id) REFERENCES comentario (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_86246F8DDB38439E ON likes_comentario (usuario_id)');
        $this->addSql('CREATE INDEX IDX_86246F8DF3F2D7EC ON likes_comentario (comentario_id)');
        $this->addSql('ALTER TABLE likes_comentario ADD PRIMARY KEY (usuario_id, comentario_id)');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F967EB2C349');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F9610560508');
        $this->addSql('DROP INDEX IDX_31205F967EB2C349 ON noticia');
        $this->addSql('DROP INDEX IDX_31205F9610560508 ON noticia');
        $this->addSql('ALTER TABLE noticia ADD usuario_id INT NOT NULL, ADD categoria_id INT NOT NULL, DROP id_usuario_id, DROP id_categoria_id, CHANGE fecha_noticia fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F96DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F963397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_31205F96DB38439E ON noticia (usuario_id)');
        $this->addSql('CREATE INDEX IDX_31205F963397707A ON noticia (categoria_id)');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C2337EB2C349');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C23378D72367');
        $this->addSql('DROP INDEX IDX_A8B6C2337EB2C349 ON post_tema');
        $this->addSql('DROP INDEX IDX_A8B6C23378D72367 ON post_tema');
        $this->addSql('ALTER TABLE post_tema ADD usuario_id INT NOT NULL, ADD tema_id INT NOT NULL, DROP id_usuario_id, DROP id_tema_id, CHANGE texto_post texto LONGTEXT NOT NULL, CHANGE fecha_post fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C233DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C233A64A8A17 FOREIGN KEY (tema_id) REFERENCES tema_foro (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A8B6C233DB38439E ON post_tema (usuario_id)');
        $this->addSql('CREATE INDEX IDX_A8B6C233A64A8A17 ON post_tema (tema_id)');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C217DB38439E');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2173397707A');
        $this->addSql('ALTER TABLE tema_foro ADD descripcion VARCHAR(255) NOT NULL, CHANGE titulo_tema titulo VARCHAR(255) NOT NULL, CHANGE texto_tema texto LONGTEXT NOT NULL, CHANGE fecha_tema fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C217DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2173397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario CHANGE nombre_usuario nombre VARCHAR(255) NOT NULL, CHANGE roll roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE likes_noticia (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_noticia_id INT NOT NULL, UNIQUE INDEX UNIQ_839933647EB2C349 (id_usuario_id), UNIQUE INDEX UNIQ_839933643C18E0C7 (id_noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933647EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933643C18E0C7 FOREIGN KEY (id_noticia_id) REFERENCES noticia (id)');
        $this->addSql('ALTER TABLE categoria CHANGE nombre nombre_categoria VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702DB38439E');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70299926010');
        $this->addSql('DROP INDEX IDX_4B91E702DB38439E ON comentario');
        $this->addSql('DROP INDEX IDX_4B91E70299926010 ON comentario');
        $this->addSql('ALTER TABLE comentario ADD id_usuario_id INT NOT NULL, ADD id_noticia_id INT NOT NULL, DROP usuario_id, DROP noticia_id, CHANGE texto texto_comentario LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha_comentario DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7027EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7023C18E0C7 FOREIGN KEY (id_noticia_id) REFERENCES noticia (id)');
        $this->addSql('CREATE INDEX IDX_4B91E7027EB2C349 ON comentario (id_usuario_id)');
        $this->addSql('CREATE INDEX IDX_4B91E7023C18E0C7 ON comentario (id_noticia_id)');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8DDB38439E');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8DF3F2D7EC');
        $this->addSql('DROP INDEX IDX_86246F8DDB38439E ON likes_comentario');
        $this->addSql('DROP INDEX IDX_86246F8DF3F2D7EC ON likes_comentario');
        $this->addSql('ALTER TABLE likes_comentario ADD id INT AUTO_INCREMENT NOT NULL, ADD id_usuario_id INT NOT NULL, ADD id_comentario_id INT NOT NULL, DROP usuario_id, DROP comentario_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8D7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8D4DDA0689 FOREIGN KEY (id_comentario_id) REFERENCES comentario (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_86246F8D7EB2C349 ON likes_comentario (id_usuario_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_86246F8D4DDA0689 ON likes_comentario (id_comentario_id)');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F96DB38439E');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F963397707A');
        $this->addSql('DROP INDEX IDX_31205F96DB38439E ON noticia');
        $this->addSql('DROP INDEX IDX_31205F963397707A ON noticia');
        $this->addSql('ALTER TABLE noticia ADD id_usuario_id INT NOT NULL, ADD id_categoria_id INT NOT NULL, DROP usuario_id, DROP categoria_id, CHANGE fecha fecha_noticia DATETIME NOT NULL');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F967EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F9610560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_31205F967EB2C349 ON noticia (id_usuario_id)');
        $this->addSql('CREATE INDEX IDX_31205F9610560508 ON noticia (id_categoria_id)');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C233DB38439E');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C233A64A8A17');
        $this->addSql('DROP INDEX IDX_A8B6C233DB38439E ON post_tema');
        $this->addSql('DROP INDEX IDX_A8B6C233A64A8A17 ON post_tema');
        $this->addSql('ALTER TABLE post_tema ADD id_usuario_id INT NOT NULL, ADD id_tema_id INT NOT NULL, DROP usuario_id, DROP tema_id, CHANGE texto texto_post LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha_post DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C2337EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C23378D72367 FOREIGN KEY (id_tema_id) REFERENCES tema_foro (id)');
        $this->addSql('CREATE INDEX IDX_A8B6C2337EB2C349 ON post_tema (id_usuario_id)');
        $this->addSql('CREATE INDEX IDX_A8B6C23378D72367 ON post_tema (id_tema_id)');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C217DB38439E');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2173397707A');
        $this->addSql('ALTER TABLE tema_foro ADD titulo_tema VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP titulo, DROP descripcion, CHANGE texto texto_tema LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha_tema DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C217DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2173397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE usuario CHANGE nombre nombre_usuario VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roll LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\'');
    }
}
