<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoordonateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"Coordonateur:read"}},
 *  denormalizationContext={"groups"={"Coordonateur:write"}},
 * )
 * @ORM\Entity(repositoryClass=CoordonateurRepository::class)
 */
class Coordonateur extends User
{

    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="coordonateur")
     * @ApiSubresource()
     * @Groups({"Coordonateur:read"})
     * @Groups({"Coordonateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="coordonateur")
     * @ApiSubresource()
     * @Groups({"Coordonateur:read"})
     * @Groups({"Coordonateur:write"})
     */
    private $courier;

    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->courier = new ArrayCollection();
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
            $ficheDeControle->setCoordonateur($this);
        }

        return $this;
    }

    public function removeFicheDeControle(FicheDeControle $ficheDeControle): self
    {
        if ($this->FicheDeControle->removeElement($ficheDeControle)) {
            // set the owning side to null (unless already changed)
            if ($ficheDeControle->getCoordonateur() === $this) {
                $ficheDeControle->setCoordonateur(null);
            }
        }

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
            $courier->setCoordonateur($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->courier->removeElement($courier)) {
            // set the owning side to null (unless already changed)
            if ($courier->getCoordonateur() === $this) {
                $courier->setCoordonateur(null);
            }
        }

        return $this;
    }
}
