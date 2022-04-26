<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RapportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RapportRepository::class)
 */
class Rapport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="rapport")
     */
    private $courier;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinateur::class, inversedBy="rapports")
     */
    private $coordinateur;

    public function __construct()
    {
        $this->courier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Courier>
     */
    public function getCourier(): Collection
    {
        return $this->courier;
    }

    public function addCourier(Courier $courier): self
    {
        if (!$this->courier->contains($courier)) {
            $this->courier[] = $courier;
            $courier->setRapport($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->courier->removeElement($courier)) {
            // set the owning side to null (unless already changed)
            if ($courier->getRapport() === $this) {
                $courier->setRapport(null);
            }
        }

        return $this;
    }

    public function getCoordinateur(): ?Coordinateur
    {
        return $this->coordinateur;
    }

    public function setCoordinateur(?Coordinateur $coordinateur): self
    {
        $this->coordinateur = $coordinateur;

        return $this;
    }
}
