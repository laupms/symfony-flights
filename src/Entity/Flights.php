<?php

namespace App\Entity;

use App\Entity\Cities;
use App\Repository\FlightsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: FlightsRepository::class)]
class Flights
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\GeneratedValue]
    #[ORM\Column(length: 6)]
    private ?string $num = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $departure = null;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy:'name')]
    #[ORM\JoinColumn(nullable:false, name:'city_departure')]
    private $city_departure = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrival = null;

    #[ORM\ManyToOne(targetEntity: Cities::class, inversedBy:'name')]
    #[ORM\JoinColumn(nullable:false, name:'city_arrival')]
    private $city_arrival = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $discount = null;

    #[ORM\Column]
    private ?int $nb_seat = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): static
    {
        $this->num = $num;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function setDeparture(\DateTimeInterface $departure): static
    {
        $this->departure = $departure;

        return $this;
    }

    public function getCityDeparture(): ?Cities
    {
        return $this->city_departure;
    }

    public function setCityDeparture(?Cities $city_departure): self
    {
        $this->city_departure = $city_departure;

        return $this;
    }

    public function getArrival(): ?\DateTimeInterface
    {
        return $this->arrival;
    }

    public function setArrival(\DateTimeInterface $arrival): static
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getCityArrival()
    {
        return $this->city_arrival;
    }

    public function setCityArrival($city_arrival): static
    {
        $this->city_arrival = $city_arrival;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isDiscount(): ?bool
    {
        return $this->discount;
    }

    public function setDiscount(bool $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getNbSeat(): ?int
    {
        return $this->nb_seat;
    }

    public function setNbSeat(int $nb_seat): static
    {
        $this->nb_seat = $nb_seat;

        return $this;
    }
}
