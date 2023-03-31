<?php

namespace App\Entity\Stations;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User\User;
use App\Entity\Requests\Request;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations:[
    new Get(
        security: "is_granted('ROLE_USER')"
    ),
    new Post (
        denormalizationContext: ['groups' => 'createStation'],
        security: "is_granted('ROLE_ADMIN')"),
    new GetCollection(
        security: "is_granted('ROLE_USER')"
    ),
    new Delete(
        security: "is_granted('ROLE_ADMIN')"
    ),
    new Put(
        security: "is_granted('ROLE_ADMIN')"
    )
])]
#[ORM\Entity]
class Station 
{ 

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'text', nullable: false)]
    #[Groups('createStation')]
    public string $name;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "stationBossId")]
    #[ORM\JoinColumn(nullable: true)]
    private $stationsBoss;

    public function getStationBoss(): ?User
    {
        return $this->stationsBoss;
    }

    public function setStationBoss(?User $user): self
    {
        $this->stationsBoss = $user;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "whereTo")]
    private $station1;

    public function getWhereRequest(): Collection
    {
        return $this->station1;
    }

    public function setWhereRequest(?Request $request): self
    {
        $this->station1 = $request;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "whitherTo")]
    private $station2;

    public function getWhitherRequest(): Collection
    {
        return $this->station2;
    }

    public function setWhitherRequest(?Station $station): self
    {
        $this->station2 = $station;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}