<?php

namespace App\Entity;

use App\Repository\HoteleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoteleRepository::class)]
class Hotele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $locale = null;

    #[ORM\Column]
    private ?int $nb_de_start = null;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\OneToMany(targetEntity: Employe::class, mappedBy: 'hotele')]
    private Collection $employes;

    /**
     * @var Collection<int, ChaineHotaliere>
     */
    #[ORM\ManyToMany(targetEntity: ChaineHotaliere::class, mappedBy: 'hotele')]
    private Collection $chaineHotalieres;

    /**
     * @var Collection<int, Room>
     */
    #[ORM\OneToMany(targetEntity: Room::class, mappedBy: 'hotele')]
    private Collection $room;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->chaineHotalieres = new ArrayCollection();
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function getNbDeStart(): ?int
    {
        return $this->nb_de_start;
    }

    public function setNbDeStart(int $nb_de_start): static
    {
        $this->nb_de_start = $nb_de_start;

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employe $employe): static
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->setHotele($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getHotele() === $this) {
                $employe->setHotele(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ChaineHotaliere>
     */
    public function getChaineHotalieres(): Collection
    {
        return $this->chaineHotalieres;
    }

    public function addChaineHotaliere(ChaineHotaliere $chaineHotaliere): static
    {
        if (!$this->chaineHotalieres->contains($chaineHotaliere)) {
            $this->chaineHotalieres->add($chaineHotaliere);
            $chaineHotaliere->addHotele($this);
        }

        return $this;
    }

    public function removeChaineHotaliere(ChaineHotaliere $chaineHotaliere): static
    {
        if ($this->chaineHotalieres->removeElement($chaineHotaliere)) {
            $chaineHotaliere->removeHotele($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->room->contains($room)) {
            $this->room->add($room);
            $room->setHotele($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotele() === $this) {
                $room->setHotele(null);
            }
        }

        return $this;
    }
}
