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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Usuario::class, inversedBy="likesComentario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToOne(targetEntity=Comentario::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $comentario;

    public function getId(): ?int
    {
        return $this->id;
    }

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
