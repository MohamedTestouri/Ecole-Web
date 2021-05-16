<?php

namespace App\Entity;

use App\Repository\TableformationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TableformationsRepository::class)
 * @Vich\Uploadable()
 */
class Tableformations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("formations:read")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups("formations:read")
     */
    private $filename;

    /**
     * @var File\null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     * @Groups("formations:read")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Code is required")
     * @Groups("formations:read")
     */
    private $Code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Titre is required")
     * @Groups("formations:read")
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Description is required")
     * @Groups("formations:read")
     *  @Assert\Length(
     *     min = 10,
     *     max= 100,
     *     minMessage = "La Description d'une formation doit comporter au moins {{ limit }} caractéres",
     *     maxMessage = "La Description d'une formation doit comporter au plus {{ limit }} caractéres"
     * )
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Duree is required")
     * @Groups("formations:read")
     */
    private $Duree;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Type is required")
     * @Groups("formations:read")
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Prix is required")
     * @Groups("formations:read")
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Etat is required")
     * @Groups("formations:read")
     */
    private $Etat;



    /**
     * @ORM\ManyToMany(targetEntity=Tablecours::class, inversedBy="formations")
     */
    private $cours;
    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="idFormation")
     */
    private $participations;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime|null
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="formations", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->Duree;
    }

    public function setDuree(string $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }



    /**
     * @return Collection|Tablecours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Tablecours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
        }

        return $this;
    }

    public function removeCour(Tablecours $cour): self
    {
        $this->cours->removeElement($cour);

        return $this;
    }



    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Tableformations
     */
    public function setFilename(?string $filename): Tableformations
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File\null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Tableformations
     */
    public function setImageFile(?File $imageFile): Tableformations
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setIdFormation($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getIdFormation() === $this) {
                $participation->setIdFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFormations($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getFormations() === $this) {
                $comment->setFormations(null);
            }
        }

        return $this;
    }

}
