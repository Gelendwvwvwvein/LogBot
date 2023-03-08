<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use function PHPSTORM_META\type;

#[ApiResource]


#[ORM\Entity]
class Station 
{ 

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'integer', unique:true)]
    public int $station_num;

    public function getId(): ?int
    {
        return $this->id;
    }





}