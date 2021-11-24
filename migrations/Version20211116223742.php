<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116223742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre_categoria VARCHAR(25) NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_noticia_id INT NOT NULL, texto_comentario LONGTEXT NOT NULL, fecha_comentario DATETIME NOT NULL, INDEX IDX_4B91E7027EB2C349 (id_usuario_id), INDEX IDX_4B91E7023C18E0C7 (id_noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_comentario (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_comentario_id INT NOT NULL, UNIQUE INDEX UNIQ_86246F8D7EB2C349 (id_usuario_id), UNIQUE INDEX UNIQ_86246F8D4DDA0689 (id_comentario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_noticia (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_noticia_id INT NOT NULL, UNIQUE INDEX UNIQ_839933647EB2C349 (id_usuario_id), UNIQUE INDEX UNIQ_839933643C18E0C7 (id_noticia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noticia (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_categoria_id INT NOT NULL, titular VARCHAR(255) NOT NULL, entradilla LONGTEXT NOT NULL, cuerpo LONGTEXT NOT NULL, imagen VARCHAR(255) NOT NULL, fecha_noticia DATETIME NOT NULL, INDEX IDX_31205F967EB2C349 (id_usuario_id), INDEX IDX_31205F9610560508 (id_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_tema (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_tema_id INT NOT NULL, texto_post LONGTEXT NOT NULL, fecha_post DATETIME NOT NULL, INDEX IDX_A8B6C2337EB2C349 (id_usuario_id), INDEX IDX_A8B6C23378D72367 (id_tema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tema_foro (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT NOT NULL, id_categoria_id INT NOT NULL, titulo_tema VARCHAR(255) NOT NULL, texto_tema LONGTEXT NOT NULL, fecha_tema DATETIME NOT NULL, INDEX IDX_DD05C2177EB2C349 (id_usuario_id), INDEX IDX_DD05C21710560508 (id_categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre_usuario VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nick VARCHAR(15) NOT NULL, password VARCHAR(255) NOT NULL, roll LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7027EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7023C18E0C7 FOREIGN KEY (id_noticia_id) REFERENCES noticia (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8D7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_comentario ADD CONSTRAINT FK_86246F8D4DDA0689 FOREIGN KEY (id_comentario_id) REFERENCES comentario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933647EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE likes_noticia ADD CONSTRAINT FK_839933643C18E0C7 FOREIGN KEY (id_noticia_id) REFERENCES noticia (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F967EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F9610560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C2337EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE post_tema ADD CONSTRAINT FK_A8B6C23378D72367 FOREIGN KEY (id_tema_id) REFERENCES tema_foro (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C2177EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE tema_foro ADD CONSTRAINT FK_DD05C21710560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F9610560508');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C21710560508');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8D4DDA0689');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7023C18E0C7');
        $this->addSql('ALTER TABLE likes_noticia DROP FOREIGN KEY FK_839933643C18E0C7');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C23378D72367');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7027EB2C349');
        $this->addSql('ALTER TABLE likes_comentario DROP FOREIGN KEY FK_86246F8D7EB2C349');
        $this->addSql('ALTER TABLE likes_noticia DROP FOREIGN KEY FK_839933647EB2C349');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F967EB2C349');
        $this->addSql('ALTER TABLE post_tema DROP FOREIGN KEY FK_A8B6C2337EB2C349');
        $this->addSql('ALTER TABLE tema_foro DROP FOREIGN KEY FK_DD05C2177EB2C349');
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
