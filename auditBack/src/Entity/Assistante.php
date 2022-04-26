<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AssistanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AssistanteRepository::class)
 */
class Assistante extends User
{
    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="assistante")
     */
    private $courier;

    public function __construct()
    {
        $this->courier = new ArrayCollection();
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
            $courier->setAssistante($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->courier->removeElement($courier)) {
            // set the owning side to null (unless already changed)
            if ($courier->getAssistante() === $this) {
                $courier->setAssistante(null);
            }
        }

        return $this;
    }
}
