<?php

namespace App\Entity;

use App\Repository\PostTemaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostTemaRepository::class)
 */
class PostTema
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="postTemas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=TemaForo::class)
     * @ORM\JoinColumn(name="tema_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * 
     */
    private $tema;

    /**
     * @ORM\Column(type="text")
     */
    private $texto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

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

    public function getTema(): ?TemaForo
    {
        return $this->tema;
    }

    public function setTema(?TemaForo $tema): self
    {
        $this->tema = $tema;

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
}
