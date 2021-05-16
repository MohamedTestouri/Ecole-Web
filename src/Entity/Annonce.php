<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $annonce_name;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $begin_date;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonceName(): ?string
    {
        return $this->annonce_name;
    }

    public function setAnnonceName(string $annonce_name): self
    {
        $this->annonce_name = $annonce_name;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->begin_date;
    }

    public function setBeginDate(\DateTimeInterface $begin_date): self
    {
        $this->begin_date = $begin_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
