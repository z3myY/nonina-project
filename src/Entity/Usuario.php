<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @UniqueEntity(
 *      fields={"email"},
 *      errorPath="email",
 *      message="Este email ya existe"
 * ) 
 * @UniqueEntity(
 *      fields={"nick"},
 *      errorPath="nick",
 *      message="Este nick ya existe"
 * )
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Tu nombre no puede contener un número"
     * )
     * @Assert\Length(min=3)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es valido.",
     *     mode = "html5"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\Length(min=6, max=15)
     */
    private $nick;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,20}$/",
     *     match=true,
     *     message="Tu contraseña debe tener una letra minúscula y otra mayúscula, un número, 
     *     un signo no alfanumérico y tener entre 8 y 20 caracteres."
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Noticia::class, mappedBy="usuario")
     */
    private $noticias;

    /**
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="usuario")
     */
    private $comentarios;

    /**
     * @ORM\OneToOne(targetEntity=LikesComentario::class, mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $likesComentario;

    /**
     * @ORM\OneToMany(targetEntity=TemaForo::class, mappedBy="usuario")
     */
    private $temaForos;

    /**
     * @ORM\OneToMany(targetEntity=PostTema::class, mappedBy="usuario")
     */
    private $postTemas;

    public function __construct()
    {
        $this->noticias = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->temaForos = new ArrayCollection();
        $this->postTemas = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
            $noticia->setUsuario($this);
        }

        return $this;
    }

    public function removeNoticia(Noticia $noticia): self
    {
        if ($this->noticias->removeElement($noticia)) {
            // set the owning side to null (unless already changed)
            if ($noticia->getUsuario() === $this) {
                $noticia->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setUsuario($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getUsuario() === $this) {
                $comentario->setUsuario(null);
            }
        }

        return $this;
    }

    public function getLikesComentario(): ?LikesComentario
    {
        return $this->likesComentario;
    }

    public function setLikesComentario(LikesComentario $likesComentario): self
    {
        // set the owning side of the relation if necessary
        if ($likesComentario->getUsuario() !== $this) {
            $likesComentario->setUsuario($this);
        }

        $this->likesComentario = $likesComentario;

        return $this;
    }

    /**
     * @return Collection|TemaForo[]
     */
    public function getTemaForos(): Collection
    {
        return $this->temaForos;
    }

    public function addTemaForo(TemaForo $temaForo): self
    {
        if (!$this->temaForos->contains($temaForo)) {
            $this->temaForos[] = $temaForo;
            $temaForo->setUsuario($this);
        }

        return $this;
    }

    public function removeTemaForo(TemaForo $temaForo): self
    {
        if ($this->temaForos->removeElement($temaForo)) {
            // set the owning side to null (unless already changed)
            if ($temaForo->getUsuario() === $this) {
                $temaForo->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PostTema[]
     */
    public function getPostTemas(): Collection
    {
        return $this->postTemas;
    }

    public function addPostTema(PostTema $postTema): self
    {
        if (!$this->postTemas->contains($postTema)) {
            $this->postTemas[] = $postTema;
            $postTema->setUsuario($this);
        }

        return $this;
    }

    public function removePostTema(PostTema $postTema): self
    {
        if ($this->postTemas->removeElement($postTema)) {
            // set the owning side to null (unless already changed)
            if ($postTema->getUsuario() === $this) {
                $postTema->setUsuario(null);
            }
        }

        return $this;
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Con esto garantizamos que los usuarios tengan al menos el roll [ROLE_USER]
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }
    /**
     * @see UserInterface
     */
    public function getUserIdentifier()
    {
        return (string) $this->email;
    }
}
