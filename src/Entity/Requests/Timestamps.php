<?php

namespace App\Entity\Requests;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestamps
{

    #[ORM\Column(name:"created_at", type:"datetime", nullable:true)]
    private $createdAt;

    #[ORM\Column(name:"updated_at", type:"datetime", nullable:true)]
    private $updatedAt;

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $timestamp): self
    {
        $this->createdAt = $timestamp;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setCreatedAtAutomatically()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}