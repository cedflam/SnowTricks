<?php

namespace App\Entity;

use App\Entity\Tricks;
use App\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email", message="Cet email existe déjà ! ")
 * @UniqueEntity("username", message="Ce pseudo existe déjà !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=6, max=255, minMessage="Le mot de passe doit faire 6 caractères minimum !")
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

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs ne peut être vide")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs ne peut être vide")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image(
     *  minWidth = 200,
     *  maxWidth = 400,
     *  minHeight = 200,
     *  maxHeight = 400,
     *  allowLandscape = false,
     *  allowPortrait = false,
     *  minWidthMessage = "L'image est trop petite ! Insérez une image entre 200 et 400 pixels ",
     *  maxWidthMessage = "L'image est trop grande ! Insérez une image entre 200 et 400 pixels"
     * )
     */
    private $imgProfile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

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
     
    // Ces fonctions doivent obligatoirement êtres implémentées avec UserPasswordEncoderInterface
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        //hash = la propriété hash (ou passsword)
        return $this->hash;
    }

    public function getSalt()
    {
        //Vide
    }    

    public function eraseCredentials()
    {
        //vide 
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getImgProfile()
    {
        return $this->imgProfile;
    }

    public function setImgProfile($imgProfile)
    {
        $this->imgProfile = $imgProfile;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
