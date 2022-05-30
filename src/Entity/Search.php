<?php

namespace App\Entity;

use App\Repository\SearchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchRepository::class)]
class Search
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $maxRooms;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $minBedRoom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxRooms(): ?int
    {
        return $this->maxRooms;
    }

    public function setMaxRooms(?int $maxRooms): self
    {
        $this->maxRooms = $maxRooms;

        return $this;
    }

    public function getMinBedRoom(): ?int
    {
        return $this->minBedRoom;
    }

    public function setMinBedRoom(?int $minBedRoom): self
    {
        $this->minBedRoom = $minBedRoom;

        return $this;
    }
}
