<?php

namespace App\Entity;

use App\Repository\ParticipateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipateRepository::class)
 */
class Participate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="participates")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="participates")
     */
    private $events;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateparticipate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getEvents(): ?Evenement
    {
        return $this->events;
    }

    public function setEvents(?Evenement $events): self
    {
        $this->events = $events;
        return $this;
    }

    public function getDateparticipate(): ?\DateTimeInterface
    {
        return $this->dateparticipate;
    }

    public function setDateparticipate(?\DateTimeInterface $dateparticipate): self
    {
        $this->dateparticipate = $dateparticipate;

        return $this;
    }
}
