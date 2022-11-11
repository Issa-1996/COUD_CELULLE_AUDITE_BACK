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
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="controleurs")
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"User:read"})
     */
    private $courrier;


    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->courierArrivers = new ArrayCollection();
        $this->courrier = new ArrayCollection();
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
     * @return Collection<int, Courier>
     */
    public function getCourrier(): Collection
    {
        return $this->courrier;
    }

    public function addCourrier(Courier $courrier): self
    {
        if (!$this->courrier->contains($courrier)) {
            $this->courrier[] = $courrier;
            $courrier->setControleurs($this);
        }

        return $this;
    }

    public function removeCourrier(Courier $courrier): self
    {
        if ($this->courrier->removeElement($courrier)) {
            // set the owning side to null (unless already changed)
            if ($courrier->getControleurs() === $this) {
                $courrier->setControleurs(null);
            }
        }

        return $this;
    }
}
