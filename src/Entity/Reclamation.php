<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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

    /**
     * @ORM\Column(type="date")

     */
    private $date_reclamation;

    /**
     * @ORM\Column(type="string")
     * @ORM\Column(type="string",length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="Reclamation")
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $idClient;

    /**
     * @ORM\OneToMany(targetEntity=Traitement::class, mappedBy="id_reclamation")
     */
    private $traitements;







    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->traitements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->date_reclamation;
    }

    public function setDateReclamation(): self
    {
        $this->date_reclamation = new \DateTime('now');

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient(): void
    {
        $this->idClient = 1;
    }

    /**
     * @return Collection|Traitement[]
     */
    public function getTraitements(): Collection
    {
        return $this->traitements;
    }

    public function addTraitement(Traitement $traitement): self
    {
        if (!$this->traitements->contains($traitement)) {
            $this->traitements[] = $traitement;
            $traitement->setIdReclamation($this);
        }

        return $this;
    }

    public function removeTraitement(Traitement $traitement): self
    {
        if ($this->traitements->removeElement($traitement)) {
            // set the owning side to null (unless already changed)
            if ($traitement->getIdReclamation() === $this) {
                $traitement->setIdReclamation(null);
            }
        }

        return $this;
    }



}
