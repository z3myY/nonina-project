<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Noticia::class, mappedBy="categoria")
     */
    private $noticias;

    public function __construct()
    {
        $this->noticias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection|Noticia[]
     */
    public function getNoticias(): Collection
    {
        return $this->noticias;
    }

    public function addNoticia(Noticia $noticia): self
    {
        if (!$this->noticias->contains($noticia)) {
            $this->noticias[] = $noticia;
            $noticia->setCategoria($this);
        }

        return $this;
    }

    public function removeNoticia(Noticia $noticia): self
    {
        if ($this->noticias->removeElement($noticia)) {
            // set the owning side to null (unless already changed)
            if ($noticia->getCategoria() === $this) {
                $noticia->setCategoria(null);
            }
        }

        return $this;
    }
}
