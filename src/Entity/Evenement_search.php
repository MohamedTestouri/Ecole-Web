<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
namespace App\Entity;
class Evenement_search
{
    private $nom;
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}

