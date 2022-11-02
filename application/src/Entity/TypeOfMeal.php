<?php

namespace App\Entity;

use App\Repository\TypeOfMealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfMealRepository::class)]
class TypeOfMeal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(nullable: true)]
    private ?int $displayOrder = null;

    #[ORM\OneToMany(mappedBy: 'Meal', targetEntity: FoodDiary::class)]
    private Collection $foodDiaries;

    public function __construct()
    {
        $this->foodDiaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(?int $displayOrder): self
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * @return Collection<int, FoodDiary>
     */
    public function getFoodDiaries(): Collection
    {
        return $this->foodDiaries;
    }

    public function addFoodDiary(FoodDiary $foodDiary): self
    {
        if (!$this->foodDiaries->contains($foodDiary)) {
            $this->foodDiaries->add($foodDiary);
            $foodDiary->setMeal($this);
        }

        return $this;
    }

    public function removeFoodDiary(FoodDiary $foodDiary): self
    {
        if ($this->foodDiaries->removeElement($foodDiary)) {
            // set the owning side to null (unless already changed)
            if ($foodDiary->getMeal() === $this) {
                $foodDiary->setMeal(null);
            }
        }

        return $this;
    }
}
