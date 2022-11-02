<?php

namespace App\Entity;

use App\Repository\FoodDiaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodDiaryRepository::class)]
class FoodDiary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Data
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * Horário que acordou
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $TimeWokeUp = null;

    /**
     * Alimentação
     * @var TypeOfMeal|null
     */
    #[ORM\ManyToOne(inversedBy: 'foodDiaries')]
    private ?TypeOfMeal $typeOfMeal = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $MealTime = null;

    #[ORM\Column(length: 1000)]
    private ?string $MealDescription = null;

    #[ORM\Column(length: 100)]
    private ?string $WhereWas = null;

    #[ORM\Column(length: 100)]
    private ?string $WithWhom = null;

    #[ORM\Column]
    private ?int $HungerLevel = null;

    #[ORM\Column]
    private ?int $PostMealSatietyLevel = null;

    #[ORM\ManyToOne(inversedBy: 'foodDiaries')]
    private ?SatisfactionWithFood $SatisfactionWithFood = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTimeWokeUp(): ?\DateTimeInterface
    {
        return $this->TimeWokeUp;
    }

    public function setTimeWokeUp(\DateTimeInterface $TimeWokeUp): self
    {
        $this->TimeWokeUp = $TimeWokeUp;

        return $this;
    }

    public function getTypeOfMeal(): ?TypeOfMeal
    {
        return $this->typeOfMeal;
    }

    public function setTypeOfMeal(?TypeOfMeal $typeOfMeal): self
    {
        $this->TypeOfMeal = $typeOfMeal;

        return $this;
    }

    public function getMealTime(): ?\DateTimeInterface
    {
        return $this->MealTime;
    }

    public function setMealTime(\DateTimeInterface $MealTime): self
    {
        $this->MealTime = $MealTime;

        return $this;
    }

    public function getMealDescription(): ?string
    {
        return $this->MealDescription;
    }

    public function setMealDescription(string $MealDescription): self
    {
        $this->MealDescription = $MealDescription;

        return $this;
    }

    public function getWhereWas(): ?string
    {
        return $this->WhereWas;
    }

    public function setWhereWas(string $WhereWas): self
    {
        $this->WhereWas = $WhereWas;

        return $this;
    }

    public function getWithWhom(): ?string
    {
        return $this->WithWhom;
    }

    public function setWithWhom(string $WithWhom): self
    {
        $this->WithWhom = $WithWhom;

        return $this;
    }

    public function getHungerLevel(): ?int
    {
        return $this->HungerLevel;
    }

    public function setHungerLevel(int $HungerLevel): self
    {
        $this->HungerLevel = $HungerLevel;

        return $this;
    }

    public function getPostMealSatietyLevel(): ?int
    {
        return $this->PostMealSatietyLevel;
    }

    public function setPostMealSatietyLevel(int $PostMealSatietyLevel): self
    {
        $this->PostMealSatietyLevel = $PostMealSatietyLevel;

        return $this;
    }

    public function getSatisfactionWithFood(): ?SatisfactionWithFood
    {
        return $this->SatisfactionWithFood;
    }

    public function setSatisfactionWithFood(?SatisfactionWithFood $SatisfactionWithFood): self
    {
        $this->SatisfactionWithFood = $SatisfactionWithFood;

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
