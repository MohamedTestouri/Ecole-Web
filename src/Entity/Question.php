<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=220)
     * @Assert\NotBlank(message="type is required")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Question is required")
     */
    private $question_a;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Reponse is required")
     */
    private $reponse;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     * @Assert\NotBlank(message="Reponse is required")
     */
    private $fausse_reponse;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuestionA(): ?string
    {
        return $this->question_a;
    }

    public function setQuestionA(string $question_a): self
    {
        $this->question_a = $question_a;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getFausseReponse(): ?string
    {
        return $this->fausse_reponse;
    }

    public function setFausseReponse(?string $fausse_reponse): self
    {
        $this->fausse_reponse = $fausse_reponse;

        return $this;
    }


}
