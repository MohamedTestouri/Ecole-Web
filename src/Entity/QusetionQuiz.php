<?php

namespace App\Entity;

use App\Repository\QusetionQuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QusetionQuizRepository::class)
 */
class QusetionQuiz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
     * @ORM\OneToOne(targetEntity=Question::class, cascade={"persist", "remove"})
    */


    private $question;

    /**

     * @ORM\OneToOne(targetEntity=Quiz::class, cascade={"persist", "remove"})
     */



    private $quiz;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
}
