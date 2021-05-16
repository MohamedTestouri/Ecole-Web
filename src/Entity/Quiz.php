<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("quiz:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="Nom de quiz is required")
     *  @Groups ("quiz:read")
     */
    private $nom_quiz;

    /**
     * @ORM\ManyToOne(targetEntity=Tableformations::class)
     *  @Groups ("quiz:read")
     */
    private $formation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomQuiz(): ?string
    {
        return $this->nom_quiz;
    }

    public function setNomQuiz(string $nom_quiz): self
    {
        $this->nom_quiz = $nom_quiz;

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
