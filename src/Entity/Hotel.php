<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $contactInfo = null;


    #[ORM\OneToMany(targetEntity: Room::class, mappedBy: 'hotel')]
    private Collection $Room;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'hotel')]
    private Collection $Service;

    #[ORM\ManyToOne(inversedBy: 'hotels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chaine $Chaine = null;

    public function __construct()
    {
        $this->Room = new ArrayCollection();
        $this->Service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContactInfo(): ?string
    {
        return $this->contactInfo;
    }

    public function setContactInfo(string $contactInfo): static
    {
        $this->contactInfo = $contactInfo;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRoom(): Collection
    {
        return $this->Room;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->Room->contains($room)) {
            $this->Room->add($room);
            $room->setHotel($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->Room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotel() === $this) {
                $room->setHotel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->Service;
    }

    public function addService(Service $service): static
    {
        if (!$this->Service->contains($service)) {
            $this->Service->add($service);
            $service->setHotel($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->Service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getHotel() === $this) {
                $service->setHotel(null);
            }
        }

        return $this;
    }

    public function getChaine(): ?Chaine
    {
        return $this->Chaine;
    }

    public function setChaine(?Chaine $Chaine): static
    {
        $this->Chaine = $Chaine;

        return $this;
    }
    #[ORM\Column(length: 255, nullable: true)]
    private $imagePath ;


    public function getimagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }



}
