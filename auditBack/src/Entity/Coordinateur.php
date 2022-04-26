<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoordinateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CoordinateurRepository::class)
 */
class Coordinateur extends User
{

    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="coordinateur")
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=Rapport::class, mappedBy="coordinateur")
     */
    private $rapports;

    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->rapports = new ArrayCollection();
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
            $ficheDeControle->setCoordinateur($this);
        }

        return $this;
    }

    public function removeFicheDeControle(FicheDeControle $ficheDeControle): self
    {
        if ($this->FicheDeControle->removeElement($ficheDeControle)) {
            // set the owning side to null (unless already changed)
            if ($ficheDeControle->getCoordinateur() === $this) {
                $ficheDeControle->setCoordinateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rapport>
     */
    public function getRapports(): Collection
    {
        return $this->rapports;
    }

    public function addRapport(Rapport $rapport): self
    {
        if (!$this->rapports->contains($rapport)) {
            $this->rapports[] = $rapport;
            $rapport->setCoordinateur($this);
        }

        return $this;
    }

    public function removeRapport(Rapport $rapport): self
    {
        if ($this->rapports->removeElement($rapport)) {
            // set the owning side to null (unless already changed)
            if ($rapport->getCoordinateur() === $this) {
                $rapport->setCoordinateur(null);
            }
        }

        return $this;
    }
}
