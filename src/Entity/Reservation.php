<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $checkInDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $checkOutDate = null;

    #[ORM\Column(length: 255)]
    private ?string $satuts = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $Client = null;

    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'reservation', orphanRemoval: true)]
    private Collection $Service;

    #[ORM\OneToOne(inversedBy: 'reservation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Invoice $Invoice = null;
    private $name;


    public function __construct()
    {
        $this->Service = new ArrayCollection();
        $this->Room = new ArrayCollection();
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

    public function getCheckInDate(): ?\DateTimeInterface
    {
        return $this->checkInDate;
    }

    public function setCheckInDate(\DateTimeInterface $checkInDate): static
    {
        $this->checkInDate = $checkInDate;

        return $this;
    }

    public function getCheckOutDate(): ?\DateTimeInterface
    {
        return $this->checkOutDate;
    }

    public function setCheckOutDate(\DateTimeInterface $checkOutDate): static
    {
        $this->checkOutDate = $checkOutDate;

        return $this;
    }

    public function getSatuts(): ?string
    {
        return $this->satuts;
    }

    public function setSatuts(string $satuts): static
    {
        $this->satuts = $satuts;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

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
            $service->setReservation($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->Service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getReservation() === $this) {
                $service->setReservation(null);
            }
        }

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->Invoice;
    }

    public function setInvoice(Invoice $Invoice): static
    {
        $this->Invoice = $Invoice;

        return $this;
    }
    // Implémentation de __toString()
    public function __toString(): string
    {
        return $this->name ?: 'Client #' . $this->id; // Utilisez le nom ou l'ID si le nom est manquant
    }
}
