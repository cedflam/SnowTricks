<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
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
    private $addressVid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTricks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressVid(): ?string
    {
        return $this->addressVid;
    }

    public function setAddressVid(string $addressVid): self
    {
        $this->addressVid = $addressVid;

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
