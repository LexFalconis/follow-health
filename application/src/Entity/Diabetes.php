<?php

namespace App\Entity;

use App\Repository\DiabetesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiabetesRepository::class)]
class Diabetes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Data da medição
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $MeasurementDate = null;

    /**
     * Glicemia
     * @var int|null
     */
    #[ORM\Column]
    private ?int $BloodGlucose = null;

    /**
     * Intervalo de medição - Hora
     * @var int|null
     */
    #[ORM\Column]
    private ?int $MeasurementRangeHour = null;

    /**
     * Intervalo de medição - Minuto
     * @var int|null
     */
    #[ORM\Column]
    private ?int $MeasurementRangeMinute = null;

    /**
     * Observação
     * @var string|null
     */
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $Note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeasurementDate(): ?\DateTimeInterface
    {
        return $this->MeasurementDate;
    }

    public function setMeasurementDate(\DateTimeInterface $MeasurementDate): self
    {
        $this->MeasurementDate = $MeasurementDate;

        return $this;
    }

    public function getBloodGlucose(): ?int
    {
        return $this->BloodGlucose;
    }

    public function setBloodGlucose(int $BloodGlucose): self
    {
        $this->BloodGlucose = $BloodGlucose;

        return $this;
    }

    public function getMeasurementRangeHour(): ?int
    {
        return $this->MeasurementRangeHour;
    }

    public function setMeasurementRangeHour(int $MeasurementRangeHour): self
    {
        $this->MeasurementRangeHour = $MeasurementRangeHour;

        return $this;
    }

    public function getMeasurementRangeMinute(): ?int
    {
        return $this->MeasurementRangeMinute;
    }

    public function setMeasurementRangeMinute(int $MeasurementRangeMinute): self
    {
        $this->MeasurementRangeMinute = $MeasurementRangeMinute;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): self
    {
        $this->Note = $Note;

        return $this;
    }
}
