<?php

namespace App\Entity;

use App\Repository\TagCoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TagCoursRepository::class)
 */
class TagCours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class)
     * @ORM\JoinColumn(nullable=false)
      * @Assert\NotBlank(message="Tag  is required")
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity=Tableformations::class)
     *  @Assert\NotBlank(message="Formation  is required")
     */
    private $formation;



    public function getId()
    {
        return $this->id;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    public function getFormation(): ?Tableformations
    {
        return $this->formation;
    }

    public function setFormation(?Tableformations $formation): self
    {
        $this->formation = $formation;

        return $this;
    }




}
