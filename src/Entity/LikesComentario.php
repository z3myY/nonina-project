<?php

namespace App\Entity;

use App\Repository\LikesComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikesComentarioRepository::class)
 */
class LikesComentario
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="likesComentario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Comentario::class, inversedBy="likesComentario")
     * @ORM\JoinColumn(name="comentario_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $comentario;

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getComentario(): ?Comentario
    {
        return $this->comentario;
    }

    public function setComentario(Comentario $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }
}
