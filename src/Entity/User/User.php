<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\Controller\GetUserController;
use App\Controller\RegistrationController;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Stations\Station;
use App\Entity\Requests\Request;
use App\Entity\Robots\Robot;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(operations:[
    new Get(
        uriTemplate: 'users/get-current/{id}',
        controller: GetUserController::class,
        security: "is_granted('ROLE_ADMIN')"
    ),
    new Post (
        uriTemplate: 'user/authorize',
        controller: RegistrationController::class,
        denormalizationContext: ['groups' => 'createUser'],
        security: "is_granted('ROLE_ADMIN')"
    ),
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
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct()
    {
        $this->stationBossId = new ArrayCollection();
        $this->robotBoss = new ArrayCollection();
        $this->destinations = new ArrayCollection();
        $this->sender = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    #[Groups('createUser')]
    public string $name;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    #[Groups('createUser')]
    public string $surname;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('createUser')]
    public ?string $patronymic = null;

    #[ORM\Column(nullable: false, unique: true)]
    #[Groups('createUser')]
    private string $login;

    #[ORM\Column(nullable: false)]
    #[Groups('createUser')]
    private string $password;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\OneToMany(targetEntity: Station::class, mappedBy: "stationsBoss")]
    private $stationBossId;

    public function getStationBossId(): Collection
    {
        return $this->stationBossId;
    }

    public function setStationBossId(?Station $station): self
    {
        $this->stationBossId = $station;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Robot::class, mappedBy: "robotBossId")]
    private $robotBoss;

    public function getRobotBoss(): Collection
    {
        return $this->robotBoss;
    }

    public function setRobotBoss(?Robot $robot): self
    {
        $this->robotBoss = $robot;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "users_dest")]
    private $destinations;

    public function getDest(): Collection
    {
        return $this->destinations;
    }

    public function setDest(?Request $request): self
    {
        $this->destinations = $request;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "users_sender")]
    private $sender;

    public function getSender(): Collection
    {
        return $this->sender;
    }

    public function setSender(?Request $request): self
    {
        $this->sender = $request;

        return $this;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials()
    {

    }

    /**
     * Returns the identifier for this user (e.g. username or email address).
     */


}