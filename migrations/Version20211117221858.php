<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117221858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre_categoria VARCHAR(25) NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, noticia_id INT NOT NULL, texto_comentario LONGTEXT NOT NULL, fecha_comentario DATETIME NOT NULL, INDEX IDX_4B91E702DB38439E (usuario_id), INDEX IDX_4B91E70299926010 (noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_comentario (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, comentario_id INT NOT NULL, UNIQUE INDEX UNIQ_86246F8DDB38439E (usuario_id), UNIQUE INDEX UNIQ_86246F8DF3F2D7EC (comentario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_noticia (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, noticia_id INT NOT NULL, UNIQUE INDEX UNIQ_83993364DB38439E (usuario_id), UNIQUE INDEX UNIQ_8399336499926010 (noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noticia (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, categoria_id INT NOT NULL, titular VARCHAR(255) NOT NULL, entradilla LONGTEXT NOT NULL, cuerpo LONGTEXT NOT NULL, imagen VARCHAR(255) NOT NULL, fecha_noticia DATETIME NOT NULL, INDEX IDX_31205F96DB38439E (usuario_id), INDEX IDX_31205F963397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_tema (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, tema_id INT NOT NULL, texto_post LONGTEXT NOT NULL, fecha_post DATETIME NOT NULL, INDEX IDX_A8B6C233DB38439E (usuario_id), INDEX IDX_A8B6C233A64A8A17 (tema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tema_foro (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, categoria_id INT NOT NULL, titulo_tema VARCHAR(255) NOT NULL, texto_tema LONGTEXT NOT NULL, fecha_tema DATETIME NOT NULL, INDEX IDX_DD05C217DB38439E (usuario_id), INDEX IDX_DD05C2173397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre_usuario VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nick VARCHAR(15) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70299926010 FOREIGN KEY (noticia_id) REFERENCES noticia (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8DF3F2D7EC FOREIGN KEY (comentario_id) REFERENCES comentario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_83993364DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_8399336499926010 FOREIGN KEY (noticia_id) REFERENCES noticia (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F96DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F963397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C233DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C233A64A8A17 FOREIGN KEY (tema_id) REFERENCES tema_foro (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C217DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2173397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F963397707A');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2173397707A');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8DF3F2D7EC');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70299926010');
        $this->addSql('ALTER TABLE likes_noticia DROP FOREIGN KEY FK_8399336499926010');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C233A64A8A17');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702DB38439E');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8DDB38439E');
        $this->addSql('ALTER TABLE likes_noticia DROP FOREIGN KEY FK_83993364DB38439E');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F96DB38439E');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C233DB38439E');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C217DB38439E');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE likes_comentario');
        $this->addSql('DROP TABLE likes_noticia');
        $this->addSql('DROP TABLE noticia');
        $this->addSql('DROP TABLE post_tema');
        $this->addSql('DROP TABLE tema_foro');
        $this->addSql('DROP TABLE usuario');
    }
}
