<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ControleurRepository;
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
*   normalizationContext={"groups"={"Controleur:read"}},
 *  denormalizationContext={"groups"={"Controleur:write"}},
 * )
 * @ORM\Entity(repositoryClass=ControleurRepository::class)
 */
class Controleur extends User
{
    /**
     * @ORM\OneToMany(targetEntity=FicheDeControle::class, mappedBy="controleur",cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"Controleur:read"})
     * @Groups({"Controleur:write"})
     * @Groups({"User:read"})
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     */
    private $FicheDeControle;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="controleur")
     * @Groups({"Controleur:read"})
     * @Groups({"Controleur:write"})
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
            $ficheDeControle->setControleur($this);
        }

        return $this;
    }

    public function removeFicheDeControle(FicheDeControle $ficheDeControle): self
    {
        if ($this->FicheDeControle->removeElement($ficheDeControle)) {
            // set the owning side to null (unless already changed)
            if ($ficheDeControle->getControleur() === $this) {
                $ficheDeControle->setControleur(null);
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
            $courrier->setControleur($this);
        }

        return $this;
    }

    public function removeCourrier(Courier $courrier): self
    {
        if ($this->courrier->removeElement($courrier)) {
            // set the owning side to null (unless already changed)
            if ($courrier->getControleur() === $this) {
                $courrier->setControleur(null);
            }
        }

        return $this;
    }
}
