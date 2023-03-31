<?php
namespace App\Entity\Robots;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use App\Entity\Requests\Request;
use App\Entity\User\User;
use App\Entity\Stations\Station;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations:[
    new Get(
        security: "is_granted('ROLE_ADMIN')"
    ),
    new Post (
        denormalizationContext: ['groups' => 'createRobot'],
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
#[ORM\Entity]
class Robot{

    public function __construct()
    {
        $this->robotNumber = new ArrayCollection();
    }
    
    public const ROBOT_STATUS_ON_CONFIRMATION = 0;
    public const ROBOT_STATUS_CONFIRMED = 1;
    public const ROBOT_STATUS_IN_PROCESS = 2;
    public const ROBOT_STATUS_DONE = 3;

     #[ORM\Id]
     #[ORM\Column(type: "integer")]
     #[ORM\GeneratedValue (strategy: 'AUTO')]
     private int $id;

    #[ORM\Column(type: "text")]
    #[Groups('createRobot')]
    private string $location;

    #[ORM\Column(type:"string", length: 255)]
    #[Groups('createRobot')]
    private string $charge;

    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups('createRobot')]
    private int $status;

    #[ORM\Column(type: "integer")]
    #[Groups('createRobot')]
    public int $enabled;

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "robotId")]
    private $robotNumber;

    public function getRobot(): Collection
    {
        return $this->robotNumber;
    }

    public function setRobot(?Request $request): self
    {
        $this->robotNumber = $request;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "robotBoss")]
    private $robotBossId;

    public function getRobotBossId(): ?User
    {
        return $this->robotBossId;
    }

    public function setRobotBossId(?User $user): self
    {
        $this->robotBossId = $user;

        return $this;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getLocation(): ?string{
        return $this->location;
    }
    public function setLocation(string $location): self{
        $this->location = $location;
        return $this;
    }
    public function getCharge(): ?string{
        return $this->charge;
    }
    public function setCharge(string $charge): self{
        $this->charge = $charge;
        return $this;
    }
    public function getStatus(): ?string{
        return $this->status;
    }
    public function setStatus(string $status): self{
        $this->status = $status;
        return $this;
    }
}
?>