<?php

namespace App\Entity\Requests;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User\User;
use App\Entity\Stations\Station;
use App\Entity\Robots\Robot;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;

#[ApiResource(operations:[
    new Get(
        security: "is_granted('ROLE_USER')"
    ),
    new Post (
        security: "is_granted('ROLE_USER')"
    ),
    new GetCollection(
        security: "is_granted('ROLE_USER')"
    ),
    new Delete(
        security: "is_granted('ROLE_USER')"
    ),
    new Put(
        security: "is_granted('ROLE_USER')"
    )
])]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Request 
{ 
    public const REQUEST_STATUS_ON_CONFIRMATION = 0;
    public const REQUEST_STATUS_CONFIRMED = 1;
    public const REQUEST_STATUS_IN_PROCESS = 2;
    public const REQUEST_STATUS_DONE = 3;

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    public int $requestStatus;

    #[ORM\ManyToOne(targetEntity: Robot::class, inversedBy: "robot")]
    private $robotId;

    #[ORM\Column (type: "datetime")]
    private $createdAt;

    use Timestamps;

    public function getRobotId(): ?Robot
    {
        return $this->robotId;
    }

    public function setRobotId(?Robot $robotNumber): self
    {
        $this->robotId = $robotNumber;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "destinations")]
    private $users_dest;

    public function getUserDest(): ?User
    {
        return $this->users_dest;
    }

    public function setUserDest(?User $user): self
    {
        $this->users_dest = $user;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "sender")]
    private $users_sender;

    public function getUserSend(): ?User
    {
        return $this->users_sender;
    }

    public function setUserSend(?User $user): self
    {
        $this->users_sender = $user;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: "stationWhere")]
    private $whereTo;

    public function getWhereTo(): ?Station
    {
        return $this->whereTo;
    }

    public function setWhereTo(?Station $station): self
    {
        $this->whereTo = $station;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: "station2")]
    private $whitherTo;

    public function getWhitherTo(): ?Station
    {
        return $this->whitherTo;
    }

    public function setWhitherTo(?Station $station): self
    {
        $this->whitherTo = $station;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}