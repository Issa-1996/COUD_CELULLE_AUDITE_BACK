<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoordinateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *  attributes={
 *         "security"="is_granted('ROLE_COORDINATEUR', 'ROLE_SUPERADMIN')", 
 *         "security_message"="Vous n'avez pas access à cette Ressource",
 *     },
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"Coordinateur:read"}},
 *  denormalizationContext={"groups"={"Coordinateur:write"}},
 * )
 * @ORM\Entity(repositoryClass=CoordinateurRepository::class)
 */
class Coordinateur extends User
{

    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="coordinateur")
     * @ApiSubresource()
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=Rapport::class, mappedBy="coordinateur",cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     */
    private $rapports;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="coordinateur")
     * @ApiSubresource()
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     */
    private $courier;

    public function __construct()
    {
        $this->FicheDeControle = new ArrayCollection();
        $this->rapports = new ArrayCollection();
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
            $courier->setCoordinateur($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->courier->removeElement($courier)) {
            // set the owning side to null (unless already changed)
            if ($courier->getCoordinateur() === $this) {
                $courier->setCoordinateur(null);
            }
        }

        return $this;
    }
}
