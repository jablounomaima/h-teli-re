<?php

namespace App\Entity;

use App\Repository\ChaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChaineRepository::class)]
class Chaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $nb_hotel = null;

    #[ORM\OneToMany(targetEntity: Hotel::class, mappedBy: 'Chaine')]
    private Collection $hotels;

    #[ORM\OneToOne(mappedBy: 'Chaine', cascade: ['persist', 'remove'])]
    private ?Admin $admin = null;

    public function __construct()
    {
        $this->hotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNbHotel(): ?int
    {
        return $this->nb_hotel;
    }

    public function setNbHotel(int $nb_hotel): static
    {
        $this->nb_hotel = $nb_hotel;

        return $this;
    }

    /**
     * @return Collection<int, Hotel>
     */
    public function getHotels(): Collection
    {
        return $this->hotels;
    }

    public function addHotel(Hotel $hotel): static
    {
        if (!$this->hotels->contains($hotel)) {
            $this->hotels->add($hotel);
            $hotel->setChaine($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): static
    {
        if ($this->hotels->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getChaine() === $this) {
                $hotel->setChaine(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(Admin $admin): static
    {
        // set the owning side of the relation if necessary
        if ($admin->getChaine() !== $this) {
            $admin->setChaine($this);
        }

        $this->admin = $admin;

        return $this;
    }
}
