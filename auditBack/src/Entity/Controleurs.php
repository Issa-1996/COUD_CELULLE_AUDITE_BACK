<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ControleursRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
*     collectionOperations={"POST","GET"},
*     itemOperations={"PUT","GET"},
*   normalizationContext={"groups"={"Controleurs:read"}},
 *  denormalizationContext={"groups"={"Controleurs:write"}},
 * )
 * @ORM\Entity(repositoryClass=ControleursRepository::class)
 */
class Controleurs extends User
{
    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="controleurs",cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"User:read"})
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=CourierArriver::class, mappedBy="controleurs")
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"User:read"})
     */
    private $courierArrivers;


    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->courierArrivers = new ArrayCollection();
    }

    /**
     * @return Collection<int, FicheDeControle>
     */
    public function getFicheDeControle(): Collection
    {
        return $this->FicheDeControle;
    }

    public function addFicheDeControle(FicheDeControle $ficheDeControle): self
    {
        if (!$this->FicheDeControle->contains($ficheDeControle)) {
            $this->FicheDeControle[] = $ficheDeControle;
            $ficheDeControle->setControleurs($this);
        }

        return $this;
    }

    public function removeFicheDeControle(FicheDeControle $ficheDeControle): self
    {
        if ($this->FicheDeControle->removeElement($ficheDeControle)) {
            // set the owning side to null (unless already changed)
            if ($ficheDeControle->getControleurs() === $this) {
                $ficheDeControle->setControleurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CourierArriver>
     */
    public function getCourierArrivers(): Collection
    {
        return $this->courierArrivers;
    }

    public function addCourierArriver(CourierArriver $courierArriver): self
    {
        if (!$this->courierArrivers->contains($courierArriver)) {
            $this->courierArrivers[] = $courierArriver;
            $courierArriver->setControleurs($this);
        }

        return $this;
    }

    public function removeCourierArriver(CourierArriver $courierArriver): self
    {
        if ($this->courierArrivers->removeElement($courierArriver)) {
            // set the owning side to null (unless already changed)
            if ($courierArriver->getControleurs() === $this) {
                $courierArriver->setControleurs(null);
            }
        }

        return $this;
    }
}
