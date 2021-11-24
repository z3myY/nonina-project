<?php

namespace App\Entity;

use App\Repository\LikesNoticiaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikesNoticiaRepository::class)
 */
class LikesNoticia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Usuario::class, inversedBy="likesNoticia", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToOne(targetEntity=Noticia::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $noticia;

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

    public function getNoticia(): ?Noticia
    {
        return $this->noticia;
    }

    public function setNoticia(Noticia $noticia): self
    {
        $this->noticia = $noticia;

        return $this;
    }
}
