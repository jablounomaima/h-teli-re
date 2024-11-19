<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Base;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe extends User
{

    #[ORM\Column]
    private ?int $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column]
    private ?float $salaire = null;





    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getHotele(): ?Hotele
    {
        return $this->hotele;
    }

    public function setHotele(?Hotele $hotele): static
    {
        $this->hotele = $hotele;

        return $this;
    }
}
