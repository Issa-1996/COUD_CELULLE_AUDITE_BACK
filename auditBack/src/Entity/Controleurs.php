<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ControleursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ControleursRepository::class)
 */
class Controleurs extends User
{
    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="controleurs")
     */
    private $FicheDeControle;

    /**
     * @ORM\ManyToMany(targetEntity=Courier::class, mappedBy="controleurs")
     */
    private $couriers;

    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->couriers = new ArrayCollection();
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
    public function getCouriers(): Collection
    {
        return $this->couriers;
    }

    public function addCourier(Courier $courier): self
    {
        if (!$this->couriers->contains($courier)) {
            $this->couriers[] = $courier;
            $courier->addControleur($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->couriers->removeElement($courier)) {
            $courier->removeControleur($this);
        }

        return $this;
    }
}
