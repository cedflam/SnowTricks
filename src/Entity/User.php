<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tricks", mappedBy="idAuthor", orphanRemoval=true)
     */
    private $idTricks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="idAuthor")
     */
    private $comments;

    public function __construct()
    {
        $this->idTricks = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return Collection|Tricks[]
     */
    public function getIdTricks(): Collection
    {
        return $this->idTricks;
    }

    public function addIdTrick(Tricks $idTrick): self
    {
        if (!$this->idTricks->contains($idTrick)) {
            $this->idTricks[] = $idTrick;
            $idTrick->setIdAuthor($this);
        }

        return $this;
    }

    public function removeIdTrick(Tricks $idTrick): self
    {
        if ($this->idTricks->contains($idTrick)) {
            $this->idTricks->removeElement($idTrick);
            // set the owning side to null (unless already changed)
            if ($idTrick->getIdAuthor() === $this) {
                $idTrick->setIdAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdAuthor() === $this) {
                $comment->setIdAuthor(null);
            }
        }

        return $this;
    }
}
