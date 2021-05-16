<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TraitementRepository::class)
 */
class Traitement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reclamation::class, inversedBy="traitements")
     */
    private $id_reclamation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Commentaire is required")
     * @Assert\Length(
     *     min = 4,
     *     max= 255,
     *     minMessage = "Le commentaire doit comporter au moins {{ limit }} caractéres",
     *     maxMessage = "Le commentaire doit comporter au plus {{ limit }} caractéres"
     * )
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReclamation(): ?reclamation
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation(?reclamation $id_reclamation): self
    {
        $this->id_reclamation = $id_reclamation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
