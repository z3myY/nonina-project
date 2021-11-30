<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComentarioRepository::class)
 */
class Comentario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="comentarios")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Noticia::class, inversedBy="comentarios")
     * @ORM\JoinColumn(name="noticia_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $noticia;

    /**
     * @ORM\Column(type="text")
     */
    private $texto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity=LikesComentario::class, mappedBy="comentario", cascade={"persist", "remove"})
     */
    private $likesComentario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getNoticia(): ?Noticia
    {
        return $this->noticia;
    }

    public function setNoticia(?Noticia $noticia): self
    {
        $this->noticia = $noticia;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }


    public function getLikesComentario(): ?LikesComentario
    {
        return $this->likesComentario;
    }

    public function setLikesComentario(LikesComentario $likesComentario): self
    {
        // set the owning side of the relation if necessary
        if ($likesComentario->getComentario() !== $this) {
            $likesComentario->setComentario($this);
        }

        $this->likesComentario = $likesComentario;

        return $this;
    }
}
