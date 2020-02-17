<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksRepository")
 * @UniqueEntity("name", message="Ce tricks existe déjà !")
 */
class Tricks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min=3, 
     *  max=30, 
     *  minMessage="Le nom de la figure doit faire plus de 3 caractères",
     *  maxMessage="Le nom de la figure doit faire moins de 30 caractères"
     * )
     *
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *  min=50,
     *  max=500,
     *  minMessage="Le contenu doit faire plus de 50 caractères",
     *  maxMessage="Le contenu doit faire moins de 500 caractères"
     * )
     *
     */
    private $contentTricks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="idTricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="idTricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAuthor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="idTricks", orphanRemoval=true)
     *
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="idTricks", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="idTricks", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min=10,
     *  max=50,
     *  minMessage="L'introduction doit faire plus de 10 caractères",
     *  maxMessage="L'introduction dot faire moins de 50 caractères"
     * )
     *
     */
    private $sentence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="date")
     */
    private $addDate;    

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $editDate;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->addDate = new \DateTime('NOW');
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContentTricks(): ?string
    {
        return $this->contentTricks;
    }

    public function setContentTricks(string $contentTricks): self
    {
        $this->contentTricks = $contentTricks;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Category $idCategory): self
    {
        $this->idCategory = $idCategory;

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
            $comment->setIdTricks($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdTricks() === $this) {
                $comment->setIdTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setIdTricks($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getIdTricks() === $this) {
                $image->setIdTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setIdTricks($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getIdTricks() === $this) {
                $video->setIdTricks(null);
            }
        }

        return $this;
    }

    public function getSentence(): ?string
    {
        return $this->sentence;
    }

    public function setSentence(string $sentence): self
    {
        $this->sentence = $sentence;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    public function setAddDate(\DateTimeInterface $addDate): self
    {
        $this->addDate = $addDate;

        return $this;
    }

    public function getEditDate(): ?\DateTimeInterface
    {
        return $this->editDate;
    }

    public function setEditDate(?\DateTimeInterface $editDate): self
    {
        $this->editDate = $editDate;

        return $this;
    }
}
