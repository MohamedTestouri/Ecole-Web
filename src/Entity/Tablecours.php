<?php

namespace App\Entity;

use App\Repository\TablecoursRepository;
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
 * @ORM\Entity(repositoryClass=TablecoursRepository::class)
 * @Vich\Uploadable()
 */
class Tablecours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("cours:read")
     */
    private $id;
    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups("cours:read")
     */
    private $imageC;

    /**
     * @var File\null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="imageC")
     * @Groups("cours:read")
     */
    private $imageFile;


    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups("cours:read")
     */
    private $filenamePDF;



    /**
     * @var File\null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filenamePDF")
     * @Groups("cours:read")
     */
    private $PDFFile;


    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     * @Groups("cours:read")
     */
    private $filenameVIDEO;

    /**
     * @var File\null
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filenameVIDEO")
     * @Groups("cours:read")
     */
    private $VIDEOFile;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Code is required")
     * @Groups("cours:read")
     */
    private $Code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Titre is required")
     * @Groups("cours:read")
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Duree is required")
     * @Groups("cours:read")
     */
    private $Duree;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Contenu is required")
     *     @Assert\Length(
     *     min = 20,
     *     max= 250,
     *     minMessage = "Le contenu d'un cours doit comporter au moins {{ limit }} caractéres",
     *     maxMessage = "Le contenu d'un cours doit comporter au plus {{ limit }} caractéres"
     * )
     * @Groups("cours:read")
     */
    private $Contenu;





    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tableformations", mappedBy="cours")
     *
     */
    private $formations;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime|null
     * @Groups("cours:read")
     */
    private $updated_at;



    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->Code;
    }

    public function setCode(string $Code)
    {
        $this->Code = $Code;

        return $this;
    }

    public function getTitre()
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre)
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDuree()
    {
        return $this->Duree;
    }

    public function setDuree(string $Duree)
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getContenu()
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu)
    {
        $this->Contenu = $Contenu;

        return $this;
    }


    /**
     * @return Collection|Tableformations[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Tableformations $formation)
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addCour($this);
        }

        return $this;
    }

    public function removeFormation(Tableformations $formation)
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeCour($this);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageC(): ?string
    {
        return $this->imageC;
    }

    /**
     * @param string|null $imageC
     * @return Tablecours
     */
    public function setImageC(?string $imageC): Tablecours
    {
        $this->imageC = $imageC;
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
     * @return Tablecours
     */
    public function setImageFile(?File $imageFile): Tablecours
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }


    /**
     * @return string|null
     */
    public function getFilenamePDF(): ?string
    {
        return $this->filenamePDF;
    }

    /**
     * @param string|null $filenamePDF
     * @return Tablecours
     */
    public function setFilenamePDF(?string $filenamePDF): Tablecours
    {
        $this->filenamePDF = $filenamePDF;
        return $this;
    }

    /**
     * @return File\null
     */
    public function getPDFFile(): ?File
    {
        return $this->PDFFile;
    }

    /**
     * @param File|null $PDFFile
     * @return Tablecours
     */
    public function setPDFFile(?File $PDFFile): Tablecours
    {
        $this->PDFFile = $PDFFile;
        if ($this->PDFFile instanceof UploadedFile) {
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
     * @return string|null
     */
    public function getFilenameVIDEO(): ?string
    {
        return $this->filenameVIDEO;
    }

    /**
     * @param string|null $filenameVIDEO
     * @return Tablecours
     */
    public function setFilenameVIDEO(?string $filenameVIDEO): Tablecours
    {
        $this->filenameVIDEO = $filenameVIDEO;
        return $this;
    }

    /**
     * @return File\null
     */
    public function getVIDEOFile(): ?File
    {
        return $this->VIDEOFile;
    }

    /**
     * @param File|null $VIDEOFile
     * @return Tablecours
     */
    public function setVIDEOFile(?File $VIDEOFile): Tablecours
    {
        $this->VIDEOFile = $VIDEOFile;
        if ($this->VIDEOFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

}
