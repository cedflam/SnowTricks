<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $addressImg;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressImg(): ?string
    {
        return $this->addressImg;
    }

    public function setAddressImg(string $addressImg): self
    {
        $this->addressImg = $addressImg;

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
