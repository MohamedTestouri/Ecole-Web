<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Reponse  is required")
     */
    private $reponse_1;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Code is required")
     */
    private $reponse_2;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Reponse is required")
     */
    private $reponse_3;

    /**
     * @ORM\OneToOne(targetEntity=Question::class, cascade={"persist", "remove"})
     * @Assert\NotBlank(message="Reponse is required")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse1(): ?string
    {
        return $this->reponse_1;
    }

    public function setReponse1(string $reponse_1): self
    {
        $this->reponse_1 = $reponse_1;

        return $this;
    }

    public function getReponse2(): ?string
    {
        return $this->reponse_2;
    }

    public function setReponse2(string $reponse_2): self
    {
        $this->reponse_2 = $reponse_2;

        return $this;
    }

    public function getReponse3(): ?string
    {
        return $this->reponse_3;
    }

    public function setReponse3(string $reponse_3): self
    {
        $this->reponse_3 = $reponse_3;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
