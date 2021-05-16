<?php

namespace App\Entity;

use App\Repository\PubliciteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Entity(repositoryClass=PubliciteRepository::class)
 * @Vich\Uploadable
 */
class Publicite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("pub:read")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="libelle  is required")
     * @ORM\Column(type="string", length=255)
     * @Groups ("pub:read")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("pub:read")
     */
    private $image;
    /**
     * @Vich\UploadableField(mapping="publicite_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="start_date  is required")
     */

    private $start_date;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="end_date  is required")
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="description  is required")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="code_promo  is required")
     **  @Assert\Length(
     *     min = 5,
     *     max= 100,
     *     minMessage = "Le code Promo doit comporter au moins {{ limit }} caractéres",
     *     maxMessage = "La code Promo doit doit comporter au plus {{ limit }} caractéres"
     * )
     */
    private $code_promo;

    /**
     * @ORM\OneToOne(targetEntity=Tableformations::class, cascade={"persist", "remove"})
     * @Assert\NotBlank(message="id_formation  is required")
     */
    private $id_formation;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryPublicity::class)
     * @Assert\NotBlank(message="category  is required")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCodePromo(): ?string
    {
        return $this->code_promo;
    }

    public function setCodePromo(?string $code_promo): self
    {
        $this->code_promo = $code_promo;

        return $this;
    }

    public function getIdFormation(): ?Tableformations
    {
        return $this->id_formation;
    }

    public function setIdFormation(?Tableformations $id_formation): self
    {
        $this->id_formation = $id_formation;

        return $this;
    }

    public function getCategory(): ?CategoryPublicity
    {
        return $this->category;
    }

    public function setCategory(?CategoryPublicity $category): self
    {
        $this->category = $category;

        return $this;
    }
    public function setImageFile( $image = null)
    {
        $this->imageFile = $image;

    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
