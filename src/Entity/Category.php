<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champs Categorie est obligatoire")
     *
     */
    private $nameCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tricks", mappedBy="idCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTricks;

    public function __construct()
    {
        $this->idTricks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

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
            $idTrick->setIdCategory($this);
        }

        return $this;
    }

    public function removeIdTrick(Tricks $idTrick): self
    {
        if ($this->idTricks->contains($idTrick)) {
            $this->idTricks->removeElement($idTrick);
            // set the owning side to null (unless already changed)
            if ($idTrick->getIdCategory() === $this) {
                $idTrick->setIdCategory(null);
            }
        }

        return $this;
    }
}
