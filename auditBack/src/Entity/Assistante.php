<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AssistanteRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST", "GET"},
 *     itemOperations={"PUT","GET"},
 *  normalizationContext={"groups"={"Assistante:read"}},
 *  denormalizationContext={"groups"={"Assistante:write"}},
 * )
 * @ORM\Entity(repositoryClass=AssistanteRepository::class)
 */

class Assistante extends User
{
    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="assistante")
     * @ApiSubresource()
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Courier:read"})
     * @Groups({"User:read"})
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
