<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contentComment;

    /**
     * @ORM\Column(type="date")
     */
    private $dateComment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     */
    private $idAuthor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentComment(): ?string
    {
        return $this->contentComment;
    }

    public function setContentComment(string $contentComment): self
    {
        $this->contentComment = $contentComment;

        return $this;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->dateComment;
    }

    public function setDateComment(\DateTimeInterface $dateComment): self
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    public function getIdAuthor(): ?User
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(?User $idAuthor): self
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    public function getIdTricks(): ?Tricks
    {
        return $this->idTricks;
    }

    public function setIdTricks(?Tricks $idTricks): self
    {
        $this->idTricks = $idTricks;

        return $this;
    }
}
