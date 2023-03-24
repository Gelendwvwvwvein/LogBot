<?php

namespace App\Entity\Stations;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User\User;
use App\Entity\Requests\Request;

#[ApiResource]
#[ORM\Entity]
class Station 
{ 

    public function __construct()
    {
        $this->stationArrive = new ArrayCollection();
        $this->station2 = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'text', nullable: false)]
    public string $name;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "stationBossId")]
    #[ORM\JoinColumn(nullable: false)]
    private $stationsBoss;

    public function getUserBoss(): ?User
    {
        return $this->stationsBoss;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "whereTo")]
    private $stationDeparture;

    public function getWhereRequest(): Collection
    {
        return $this->stationDepartureArrive;
    }

    public function setWhereRequest(?Request $request): self
    {
        $this->stationDeparture = $request;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "whitherTo")]
    private $stationArrive;

    public function getWhitherRequest(): Collection
    {
        return $this->stationArrive;
    }

    public function setWhitherRequest(?Request $request): self
    {
        $this->stationArrive = $request;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}