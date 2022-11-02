<?php

namespace App\Entity;

use App\Repository\PressureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PressureRepository::class)]
class Pressure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Sistólica
     * @var int|null
     */
    #[ORM\Column]
    private ?int $Systolic = null;

    /**
     * Diastólica
     * @var int|null
     */
    #[ORM\Column]
    private ?int $Diastolic = null;

    /**
     * Pulso
     * @var int|null
     */
    #[ORM\Column]
    private ?int $Pulse = null;

    /**
     * Data da aferição
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSystolic(): ?int
    {
        return $this->Systolic;
    }

    public function setSystolic(int $Systolic): self
    {
        $this->Systolic = $Systolic;

        return $this;
    }

    public function getDiastolic(): ?int
    {
        return $this->Diastolic;
    }

    public function setDiastolic(int $Diastolic): self
    {
        $this->Diastolic = $Diastolic;

        return $this;
    }

    public function getPulse(): ?int
    {
        return $this->Pulse;
    }

    public function setPulse(int $Pulse): self
    {
        $this->Pulse = $Pulse;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
