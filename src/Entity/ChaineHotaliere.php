<?php

namespace App\Entity;

use App\Repository\ChaineHotaliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChaineHotaliereRepository::class)]
class ChaineHotaliere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nb_des_hotels = null;

    /**
     * @var Collection<int, Hotele>
     */
    #[ORM\ManyToMany(targetEntity: Hotele::class, inversedBy: 'chaineHotalieres')]
    private Collection $hotele;

    public function __construct()
    {
        $this->hotele = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbDesHotels(): ?int
    {
        return $this->nb_des_hotels;
    }

    public function setNbDesHotels(int $nb_des_hotels): static
    {
        $this->nb_des_hotels = $nb_des_hotels;

        return $this;
    }

    /**
     * @return Collection<int, Hotele>
     */
    public function getHotele(): Collection
    {
        return $this->hotele;
    }

    public function addHotele(Hotele $hotele): static
    {
        if (!$this->hotele->contains($hotele)) {
            $this->hotele->add($hotele);
        }

        return $this;
    }

    public function removeHotele(Hotele $hotele): static
    {
        $this->hotele->removeElement($hotele);

        return $this;
    }
}
