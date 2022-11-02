<?php

namespace App\Entity;

use App\Repository\SatisfactionWithFoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SatisfactionWithFoodRepository::class)]
class SatisfactionWithFood
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Descrição
     * @var string|null
     */
    #[ORM\Column(length: 50)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'SatisfactionWithFood', targetEntity: FoodDiary::class)]
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
            $foodDiary->setSatisfactionWithFood($this);
        }

        return $this;
    }

    public function removeFoodDiary(FoodDiary $foodDiary): self
    {
        if ($this->foodDiaries->removeElement($foodDiary)) {
            // set the owning side to null (unless already changed)
            if ($foodDiary->getSatisfactionWithFood() === $this) {
                $foodDiary->setSatisfactionWithFood(null);
            }
        }

        return $this;
    }
}
